<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class endOfYearStats extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'lebaneseBlogs:endOfYearStats';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'get statistics for end of year';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	  $this->firstDay = 1388534400;
  }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
    $this->getFacebookTop(30);
	}

  public function getListOfBlogStats(){
    $blogs = Blog::where('blog_last_post_timestamp','>',$this->firstDay)->get();
    echo "Blog Name, Posts Count, Total Virality \n";
    foreach ($blogs as $key => $blog) {
      $blogName = str_replace(',', '', $blog->blog_name);
      $bloggerPosts = Post::where('blog_id', $blog->blog_id)->get();
      $postsCount = $bloggerPosts->count();
      $totalVirality = 0;
      $totalShares = 0;
      foreach ($bloggerPosts as $key => $post) {
        $totalVirality += $post->post_virality;
      }
      echo "$blogName, $postsCount, $totalVirality \n";
    }
  }

  public function getFacebookTop($howMuch){
    //get posts with most facebook shares;
    $posts = Post::where('post_timestamp','>', $this->firstDay)->orderBy('post_facebookShares','desc')->take($howMuch)->get();
    echo "Post Title, Post URL, Facebook Shares \n";
    foreach ($posts as $key => $post) {
      $title = str_replace(',', '', $post->post_title);
      $url = $post->post_url;
      $shares =$post->post_facebookShares;
      echo "$title, $url, $shares \n";
    }
  }

  public function getTwitterTop($howMuch){
    //get posts with most facebook shares;
    $posts = Post::where('post_timestamp','>', $this->firstDay)->orderBy('post_twitterShares','desc')->take($howMuch)->get();
    echo "Post Title, Post URL, Twitter Shares \n";
    foreach ($posts as $key => $post) {
      $title = str_replace(',', '', $post->post_title);
      $url = $post->post_url;
      $shares =$post->post_twitterShares;
      echo "$title, $url, $shares \n";
    }
  }

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			//array('example', InputArgument::REQUIRED, 'An example argument.'),
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
