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
        $score = new SocialScore($post->post_url);

        // get facebook likes and shares;
        $facebookLikes = $score->getFacebookLikes();
        $facebookShares = $score->getFacebookShares();
        $facebookComments = $score->getFacebookComments();

        // weight scores by coefficients. 
        $coef_comm = 1;
        $coef_like = 2; // likes are 2 times more important than comments;
        $coef_shares = 7; // shares most important indicator. 7 times as important as comments;

        $coef_tot = $coef_comm + $coef_like + $coef_shares; 
        
        $weightedValue = round(($coef_comm * $facebookComments + $coef_like * $facebookLikes + $coef_shares * $facebookShares) / $coef_tot);

        $totalShares = $weightedValue * 2;

        // calculate virality
        $virality = $totalShares > 1 ? round( 8 * log($totalShares) ) : 2 ;

        // set virality's upper limit of 50
        if ($virality > 50) {
          $virality = 50;
        }

        $this->comment("Likes: $facebookLikes, Comments: $facebookComments, Shares: $facebookShares, Weighted Score: $weightedValue, Virality: $virality");
      
        // The social score is the combination of virality and post visits
        // Visits are twice as important as virality
        $socialScore = $post->post_visits + round($virality / 2);
        $this->comment("SocialScore (virality and visit count) : $socialScore");

        // Save The results to database;

        $post->post_virality = $virality;
        $post->post_socialScore = $socialScore;
        try {
          $post->save();
        } catch (Exception $e) {
          $this->error('Couldnt save details for post in database');
        }

      }); // Posts Loop
    
    }); // Blogs Loop
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
