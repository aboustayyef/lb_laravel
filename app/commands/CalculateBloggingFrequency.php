<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CalculateBloggingFrequency extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'lebaneseBlogs:CalculateBloggingFrequency';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Categorizes the bloggers frequency of posting';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->max_posts_to_check = 30; // choose even numbers
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		// if the 'blog' argument is set, we only crawl the feed of that blog, otherwise, we crawl all;
		if ($this->argument('blog')) {
		  $blogs = Blog::where('blog_id','=',$this->argument('blog'))->get();
		} else {
		  // get all active blogs
		  $blogs = Blog::where('blog_RSSCrawl_active','=','1')->get();
		}

		$blogs->each(function($blog){
			$post_timestamps = Post::Where('blog_id', $blog->blog_id)->orderBy('post_timestamp','desc')->take($this->max_posts_to_check)->lists('post_timestamp');
			$num_posts = $post_timestamps->count();
			$key = 0;
			$post_deltas = [];
			$total_deltas = 0;
			while (isset($post_timestamps[$key])) {
				if ($key>0) {
					$diff_in_seconds = abs($post_timestamps[$key] - $post_timestamps[$key - 1]);
					$diff_in_hours = round($diff_in_seconds / 3600);
					$post_deltas[] = $diff_in_hours;
					$total_deltas += $diff_in_hours;
				}
				$key += 1;
			}
			sort($post_deltas); // important for median calculation;

			$blog->hours_bw_posts_median = $post_deltas[$this->max_posts_to_check /2 - 1];
			$blog->hours_bw_posts_average = round($total_deltas/count($post_deltas));
			$blog->save();
			$this->info($blog->blog_name . ' statistics: average: ' . $blog->hours_bw_posts_average . ', median: ' . $blog->hours_bw_posts_median);


		});
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
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
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
