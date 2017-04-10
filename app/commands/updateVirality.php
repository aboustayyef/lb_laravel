<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class updateVirality extends Command {

  /**
   * The console command name.
   *
   * @var string
   */
  protected $name = 'lebaneseBlogs:updateVirality';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Update Virality and other social scores of posts';

  /**
   * Create a new command instance.
   *
   * @return void
   */
  
  protected $maxHoursAgoPerPost;

  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function fire()
  {

    $maxTimeAgoPerPost = 3 * 24 * 60 * 60 ; //3 days in seconds
    $hoursAgo = time() - $maxTimeAgoPerPost;

    // if the 'blog' argument is set, we only crawl the feed of that blog, otherwise, we crawl all;
    if ($this->argument('blog')) {
      $blogs = Blog::where('blog_id','=',$this->argument('blog'))->get();
    } else {
      // get all active blogs
      $blogs = Blog::where('blog_RSSCrawl_active','=','1')->get();
    }

    $blogs->each(function($blog) use ($hoursAgo){

      $this->info("Getting the virality scores for [ $blog->blog_name ]");

      $posts = Post::where('blog_id',$blog->blog_id);

      // If we are looking to all blogs (ie the blog argument is not specified)
      // then we add the time limit to posts

      if (!$this->argument('blog')) { $posts = $posts->where('post_timestamp', '>', $hoursAgo); }

      $posts = $posts->orderBy('post_timestamp','desc')->get();

      $posts->each(function($post){

        $this->info('Analysing post ' . $post->post_title);

        // initiate social score object
        $scoreHttp = new SocialScore($this->httpUrl($post->post_url));
        $scoreHttps = new SocialScore($this->httpsUrl($post->post_url));
        $viralityHttp = $scoreHttp->getVirality();
        $viralityHttps = $scoreHttps->getVirality();

        $virality = $viralityHttps >= $viralityHttp? $viralityHttps : $viralityHttp;
        $score = $viralityHttps >= $viralityHttp? $scoreHttps : $scoreHttp;
        // The social score is the combination of virality and post visits
        // Visits are twice as important as virality
        $socialScore = $post->post_visits + round($virality / 2);
        $this->comment("SocialScore (virality and visit count) : $socialScore");

        // Save The results to database;

        $post->post_virality = $virality;
        $post->post_facebookShares = $score->getFacebookAll();
        $post->post_socialScore = $socialScore;
        try {
          $post->save();
        } catch (Exception $e) {
          $this->error('Couldnt save details for post in database');
        }

      }); // Posts Loop
    
    }); // Blogs Loop
  }

  private function httpUrl($url){
    if (str_contains($url, 'https://')) {
      return str_replace('https://', 'http://', $url);
    }
    return $url;
  }

  private function httpsUrl($url){
    if (str_contains($url, 'http://')) {
      return str_replace('http://', 'https://', $url);
    }
    return $url;
  }

  /**
   * Get the console command arguments.
   *
   * @return array
   */
  
  protected function getArguments()
  {
    return array(
      array('blog', InputArgument::OPTIONAL, 'The blog to check for'),
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
      //array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
    );
  }


}
