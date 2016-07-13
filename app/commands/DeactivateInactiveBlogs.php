<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DeactivateInactiveBlogs extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'lebaneseBlogs:DeactivateInactiveBlogs';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Deactivates blogs that have not updated in a while';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->cutOffDays = 365;
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
		$result = new \Illuminate\Support\Collection;
		$blogs->each(function($blog) use($result){
			// find timestamp of last post
			$post = Post::Where('blog_id', $blog->blog_id)->orderBy('post_timestamp','desc')->first();

			// calculate difference in Days today
			if ($post) {
				$diffInDays = \Carbon\Carbon::createFromTimestamp($post->post_timestamp)->diffInDays();
				// deactivate old blogs
				if ($diffInDays > $this->cutOffDays) {
					$blog->deactivate("More than 1 year since last post");
				}
			} else {
				$diffInDays = 99999999;
				$blog->deactivate("Blog Has no Posts");
			}
			

			// push to results collection
			$result->push(['name'=>$blog->blog_name, 'days'=>$diffInDays]);
		});

		$result->sortBy('days');
		$result->each(function($r){
			$this->info("{$r['name']} : {$r['days']} days since last post");
		});
		$deactivate = $result->filter(function($r){
			return $r['days'] > $this->cutOffDays;
		})->count();

		$this->comment("$deactivate blogs have been deactivated");
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


}
