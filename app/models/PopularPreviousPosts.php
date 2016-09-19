<?php 

class PopularPreviousPosts
{
	
	public $listOfPosts, $title, $ok;

	function __construct($period = 'week')
	{
		$this->ok = false;

		if (!in_array($period, ['week','month','year'])) {
			throw new Exception("Period has to be 'week', 'month', or 'year' ", 1);
		}

		$today = new \Carbon\Carbon('today');

		switch ($period) {
			case 'week':
				$timestamp = $today->subDays(7)->timestamp;
				$this->title="Popular Posts Last Week";
				break;
			case 'month':
				$timestamp = $today->subDays(30)->timestamp;
				$this->title="Popular Posts Last Month";
				break;
			case 'year':
				$timestamp = $today->subDays(365)->timestamp;
				$this->title="Popular Posts Last Year";
				break;

			default: //week
				$timestamp = $today->subDays(7)->timestamp;
				$this->title="Popular Last Week";
				break;
		}
		$secondsPerDay = 24 * 60 * 60;
		$this->listOfPosts = Post::where('post_timestamp','>', $timestamp)
					 ->where('post_timestamp','<', $timestamp + $secondsPerDay)
					 ->orderBy('post_socialScore','desc')
					 ->take(5)->get();
		if ($this->listOfPosts->count() > 2) {

			$this->ok = true;
			
		}
		
	}
}

?>