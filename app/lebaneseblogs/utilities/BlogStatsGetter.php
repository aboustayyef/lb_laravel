<?php 

namespace LebaneseBlogs\Utilities;

use Illuminate\Support\Collection;



class BlogStatsGetter 
{
	private $blog;
	private $results;
	private $latest5posts;
	private $previous5posts;
	
	function __construct(\Blog $blog)
	{
		$this->blog = $blog;

		// Get post collections for stats gathering
		$latestPosts = $blog->posts()->orderBy('post_timestamp', 'desc')->take(10)->get()->chunk(5);
		$this->latest5posts = $latestPosts[0];
		$this->previous5posts = $latestPosts[1];

		$this->results = new Collection;


	}

	public function get()
	{
		$this->getAverageVirality();
		$this->getPostClicks();
		$this->getAveragePostsPerWeek();
		return $this->results->toArray();
	}

	

	// Average Posts per week

	private function getAveragePostsPerWeek()
	{
		$lastFive = 7*24*60*60 / (($this->latest5posts->first()->post_timestamp - $this->latest5posts->last()->post_timestamp)/5);
		$previousFive = 7*24*60*60 / (($this->previous5posts->first()->post_timestamp - $this->previous5posts->last()->post_timestamp)/5);
		if ($previousFive == 0) { $previousFive = 0.01; } // avoid division by zero
		$percentageChange = round( (( ($lastFive - $previousFive) / $previousFive ) * 100) );

		$this->results->push([
			'statTitle'			=>	'Posts Per Week',
			'statDescription'	=>	'The average amount of posts published per week',
			'value'				=>	round($lastFive,1),
			'percentageChange'	=>	$percentageChange,
			'statIcon'			=>	'fa-bar-chart'
		]);
	}


	// Total Clicks

	private function getPostClicks()
	{
		
		$lastFive = round($this->latest5posts->reduce(function($total, $post){return $post->post_visits + $total;}) / $this->latest5posts->count());
		$previousFive = round($this->previous5posts->reduce(function($total, $post){return $post->post_visits + $total;}) / $this->previous5posts->count());
		if ($previousFive == 0) { $previousFive = 0.01; } // avoid division by zero
		$percentageChange = round( (( ($lastFive - $previousFive) / $previousFive ) * 100) );

		$this->results->push([
			'statTitle'			=>	'Total Clicks',
			'statDescription'	=>	'The number of clicks on Lebanese Blogs to the last 5 blog posts',
			'value'				=>	$lastFive,
			'percentageChange'	=>	$percentageChange,
			'statIcon'			=>	'fa-dot-circle-o'
		]);
	}

	// Average Virality 

	private function getAverageVirality()
	{

		$lastFive = round($this->latest5posts->reduce(function($total, $post){return $post->post_virality + $total;}) / $this->latest5posts->count());
		$previousFive = round($this->previous5posts->reduce(function($total, $post){return $post->post_virality + $total;}) / $this->previous5posts->count());
		if ($previousFive == 0) { $previousFive = 0.01; } // avoid division by zero
		$percentageChange = round( (( ($lastFive - $previousFive) / $previousFive ) * 100) );

		$this->results->push([
			'statTitle'			=>	'Average Virality',
			'statDescription'	=>	'The average virality score of the last 5 posts',
			'value'				=>	$lastFive,
			'percentageChange'	=>	$percentageChange,
			'statIcon'			=>	'fa-bar-chart'
		]);
	}
}

?>