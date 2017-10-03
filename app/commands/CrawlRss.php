<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Aboustayyef\Summarizer;
use Illuminate\Support\Collection;
use Embed\Embed;

// use \lbFunctions;

class CrawlRss extends Command {

  private $blog;  // blog being crawled
  private $feed;  // rss feed of crawled blog
  private $hr;     // interface <hr> for terminal
  private $dhr;    // interface strong <hr> for terminal

  /**
   * The console command name.
   */
  protected $name = 'lebaneseBlogs:crawlRss';

  /**
   * The console command description.
   */
  protected $description = 'This command crawls the RSS feeds of blogs for new posts';

  /**
   * Create a new command instance.
   */
  public function __construct()
  {
    parent::__construct();
    $this->hr = str_repeat('-', 70);
    $this->dhr = str_repeat('=', 70);
  }

  /**
   * Execute the console command.
   */
  public function fire()
  {

    // Produce header
    $this->info($this->dhr);
    $this->info('Work began: '.date('d M Y , H:i:s'));
    $robot = shell_exec('whoami');
    $whichphp = shell_exec('which php');
    $this->info("Robot: $robot");
    $this->info("PHP in use: $whichphp");
    $this->info($this->dhr);

    // if the 'blog' argument is set, we only crawl the feed of that blog, otherwise, we crawl all;
    if ($this->argument('blog')) {
      $blogs = Blog::where('blog_id','=',$this->argument('blog'))->get();
    } else {
      // get all active blogs
      $blogs = Blog::where('blog_RSSCrawl_active','=','1')->get();
    }


    // loop through them to look for new posts
    $c = new Collection;
    
    foreach ($blogs as $key => $blog) {
      $this->blog = $blog;
      $this->feed = $blog->blog_rss_feed;
      try {
        $start = time();
        $this->exploreFeed();
        $duration = time() - $start;
        $c->push(['blog' => $blog->blog_name, 'duration' => $duration]);
      } catch (Exception $e) {
        $this->error($e);
      }

    }

    $this->info('Feeds Work Ended: '.date('d M Y , H:i:s'));
    $this->info('Kind of fetching used: '. $this->option('fetching'));
    Cache::forever('crawlingDurations', $c);

  } // fire

  private function exploreFeed(){
    $this->info("Now fetching posts from feed: $this->feed");

    // Initiate Simple Pie instance for feed
    $maxitems = 0; // no limit on extent of crawl
    $sp_feed = new SimplePie(); // We'll process this feed with all of the default options.
    $sp_feed->set_feed_url($this->feed); // Set which feed to process.
    $sp_feed->set_useragent('Lebanese Blogs/3.1 (+http://www.lebaneseblogs.com)');
    $sp_feed->strip_htmltags(false);
    $sp_feed->enable_cache(false);
    $sp_feed->init(); // Run SimplePie.
    $sp_feed->handle_content_type(); // This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).

    // loop through feed items
    foreach($sp_feed->get_items(0, $maxitems) as $key => $item)
    {
      // get raw post link
      $blog_post_link = $item->get_permalink();

      //resolves feedburner proxy if exists
      $canonical_resource = $item->get_item_tags("http://rssnamespace.org/feedburner/ext/1.0",'origLink');
      if (isset($canonical_resource[0]['data'])) {
        $blog_post_link = $canonical_resource[0]['data'];
      }
      $blog_post_link = urldecode($blog_post_link);

      // clean URL from junk
      $urlparts = lbFunctions::utf8_parse_url($blog_post_link);

      if (!empty($urlparts['query'])) {
        $blog_post_link .= '?'.$urlparts['query'];
        $blog_post_link= preg_replace('#&amp;#', '&', $blog_post_link);
      }

      // get post_rss_id
      $post_rss_id = $item->get_id();

      // get blogid , example: beirutspring.com -> beirutspring
      $domain = $this->blog->blog_id;

      // get timestamp
      $blog_post_timestamp =  strtotime($item->get_date()); // get post's timestamp;

      // if timestamp is in the future, assume lebanese timezone and remove 3 hours
      $now = (new Carbon\Carbon)->timestamp;
      if ( ($blog_post_timestamp - $now) > 3600 ) { // more than one hour ahead
        $blog_post_timestamp -= (3600 * 3); // knock out three hours
      }
      

      // get title & sanitize it
      $blog_post_title = lbNormalise::cleanUpText($item->get_title(), 120);
      $blog_post_title = lbNormalise::unicode_decode($blog_post_title);

      $this->info($blog_post_title);

      /*--------------------------------------------------
      | check if this post is already in the database.    |
      ---------------------------------------------------*/

      // First, remove host (http or https) to avoid counting secure links as duplicates
      $blog_post_link_without_host = preg_replace("(https?://)", "", $blog_post_link );

      // Is the post's url in the database?
      $urlExists = Post::where('post_url','like', '%'.$blog_post_link_without_host)->count();

      // Did the blogger post another post with the exact same title?
      $nameExists = Post::where('post_title', $blog_post_title)->where('blog_id', $domain)->count();

      // Did the blogger post another post with the exact same timestamp?
      $timeStampExists = Post::where('post_timestamp', $blog_post_timestamp)->where('blog_id', $domain)->count();

      //If any of the conditions above is true then the post exists
      $postExists = $urlExists + $nameExists + $timeStampExists;

      if ($postExists > 0) {

      // If the post exists

        // Add RSS ID to the post
        // This is a temporary measure so later we can use the ID comparison to find new posts
        try {

          $existingPost =  Post::where('post_title', $blog_post_title)->where('blog_id', $domain)->first();
          $existingPost->post_rss_id = $post_rss_id;
          $existingPost->save();

        } catch (Exception $e) {

          #nothing          
          
        }

        $this->comment('[ x Post already in Database ]');

        /*
        |   After a an existing post is found, Depending on the 'fetching' setting,
        |   the crawler will either move to the next feed ('thorough') or keep going through
        |   the feed until it reaches the end ('updater')
        */

        if ($this->option('fetching') == 'thorough'){
          continue;
        }else{
          break;
        }

      } else {

      // If the post doesn't exist

        $this->info('New Post: '.$blog_post_title);

        // Normalise & sanitize Content
        $blog_post_content = html_entity_decode($item->get_content(), ENT_COMPAT, 'utf-8');
        $full_blog_post_content = lbNormalise::unicode_decode($blog_post_content);
        $blog_post_content = substr($blog_post_content, 0, 7950); // larger than 8000 chars won't fit in mysql
        // remove non utf-8 characters;
        $blog_post_content = lbNormalise::unicode_decode($blog_post_content);

        // Crawl for suitable image

        try {
            $embed = Embed::create($blog_post_link);
            $image = $embed->image;
            if ($image) {
              $blog_post_image = $image;
              $blog_post_image_height = $embed->imageHeight;
              $blog_post_image_width = $embed->imageWidth;
            } else {
              $blog_post_image = null;
            }

            // use embed for canonical url
            $url = $embed->url;
            if ($url) {
              $blog_post_link = $url;
            }
        } catch (\Exception $e) {
            $this->error('could not extract image. Error Message: [' . $e . ']');
            $blog_post_image = null;
        }

        // Get Excerpt
        $summarizer = new Summarizer;
        $summarizer->text = $blog_post_content;
        $blog_post_excerpt = $summarizer->summarize(2);

        if ($blog_post_image) {
          // add hue color
          $imageAnalyzer = new imageAnalyzer($blog_post_image);
          $hue = $imageAnalyzer->getDominantHue();

        } else {
          $blog_post_image_width = 0;
          $blog_post_image_height = 0;
          $hue = 0;
        }

        // Save new record
        $post = new Post;

        $post->post_rss_id = $post_rss_id;
        $post->post_url = $blog_post_link ;
        $post->post_title = $blog_post_title ;
        $post->post_original_image = $blog_post_image ;
        $post->post_excerpt = $blog_post_excerpt ;
        $post->blog_id = $domain ;
        $post->post_timestamp = $blog_post_timestamp ;
        $post->post_content = $blog_post_content ;
        $post->post_image_width = $blog_post_image_width ;
        $post->post_image_height = $blog_post_image_height ;
        $post->post_visits = 0 ;
        $post->post_image_hue = $hue;
        $post->post_tags = $this->blog->blog_tags;

        // See if blogger has reviewed and rated in the post

        $rating = new LebaneseBlogs\Crawling\RatingExtractor($domain, $full_blog_post_content, $blog_post_link);
        $getRatings = $rating->getRating();

        if ($getRatings) {
          $post->rating_numerator = $rating->numerator;
          $post->rating_denominator = $rating->denominator;
          $this->comment('added rating ' . $rating->numerator . '/' . $rating->denominator . ' to the post ' . $post->post_title);
        }

        try {
          $post->save();
          $blog = Blog::where('blog_id', $domain)->first();
          $blog->blog_last_post_timestamp = $blog_post_timestamp;
          $blog->save();
          $this->comment('New Post Saved: "' . $blog_post_title . '"');

        } catch (Exception $e) {
          $this->error($e->getMessage()); //'Cannot save post [' . $blog_post_title . ']'
        }
        // Cache image if exists. Flatten and convert to jpg;
        $local_image_name = time() . '-' . $post->post_id;
        $candidateCachingFile = public_path() . '/img/cache/' . $local_image_name . '.jpg' ;
          if ($blog_post_image) { // image exists
            // cache it
            try {
              Image::make($blog_post_image)->fit(600,330)->save($candidateCachingFile);
              $post->post_local_image = $local_image_name;
              $post->save();
              $this->comment('Image added to cache folder');
            } catch (Exception $e) {
              $this->error('could not extract image. Error Message: [' . $e . ']');
            }
          }
          $this->info('Cache image ' . $candidateCachingFile . ' already exists');
      }

    } // end foreach feed item

  } // exploreFeed

  /**
   * Get the console command arguments.
   *
   * @return array
   */
  protected function getArguments()
  {
    return array(
      //array('blogid', InputArgument::REQUIRED, 'The Blog Id'),
      array('blog', InputArgument::OPTIONAL)
    );
  }

  /**
   * Get the console command options.
   *
   * @return array
   */
  protected function getOptions()
  {
    return array(
      // the kind of fetching can be "updater" or "thorough"
      // 'updater' breaks the loop and goes to next blog as soon as fetcher finds an existing post
      // 'thorough' goes through the entire feed to find older unlisted posts.
      array('fetching', null, InputOption::VALUE_OPTIONAL, 'method of fetching', "updater"),
    );
  }

}
