<?php 

	namespace LebaneseBlogs\Utilities;

	use Illuminate\Support\Collection;
	use \Session;
	use \Post;
	/**
	* 
	*/

	class TopPostsGetter
	{
		
		private $channel, $postsReady, $possibleTimeFrames;

		function __construct()
		{
			if (Session::has('channel')) {
			  $this->channel = Session::get('channel');
			} else {
			  $this->channel = 'all';
			}

			$this->postsReady = false;
			$this->possibleTimeFrames = [12, 24, 72, 168];
		}

		public function get() // Return collection
		{
			foreach ($this->possibleTimeFrames as $key => $hours) {
				$posts = Post::getTopPosts($this->channel, $hours);
				if ($posts->count() > 4) {
				  return $posts;
				}
			}
		}
	}

?>