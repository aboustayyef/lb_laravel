<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class getRatings extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'lebaneseBlogs:getRatings';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Checks blogger for ratings of posts';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
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
		if (!Blog::exists($this->argument('blogger'))) {
      throw new Exception("Blogger Doesn't exist", 1);
    }
      $posts = Post::where('blog_id', $this->argument('blogger'))->orderBy('post_id','desc')->take(100)->get();
      foreach ($posts as $key => $post) {
        $this->info('now crawling ' . $post->post_title );
        if ($this->argument('blogger') == 'nogarlicnoonions') {
          // because NGNO's ratings are not in the RSS feed, we use the DOM crawler.
          $rating = new LebaneseBlogs\Crawling\RatingExtractor(@file_get_contents($post->post_url));
          $getRatings = $rating->getNgnoRating();
        }else{
          $rating = new LebaneseBlogs\Crawling\RatingExtractor(strip_tags($post->post_content));
          $getRatings = $rating->getRating();
        }

      if ($getRatings) {
        $post->rating_numerator = $rating->numerator;
        $post->rating_denominator = $rating->denominator;
        $post->save();
        $this->comment('added rating ' . $rating->numerator . '/' . $rating->denominator . ' to the post ' . $post->post_title);
      }
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
			array('blogger', InputArgument::REQUIRED, 'which blogger to look for'),
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