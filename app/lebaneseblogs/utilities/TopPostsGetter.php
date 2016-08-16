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
			$this->possibleTimeFrames = [12, 24, 72, 168, 336, 1000];
		}

		public function get() // Return collection
		{

			if (Session::get('pageKind') == 'blogger') {
				$posts = Post::where('blog_id', Session::get('blogger'))->orderBy('post_virality','desc')->orderBy('post_timestamp','desc')->take(5)->get();
				return $posts;
			}

			foreach ($this->possibleTimeFrames as $key => $hours) {
				$posts = $this->getTopPosts($this->channel, $hours);
				if ($posts->count() > 4) {
				  return $posts;
				}
			}
		}

		public function getTopPosts($channel='all', $hours=12){
		  $targetTimeStamp = time() - ( $hours * 60 * 60 );
		  if (isset($channel) && $channel != 'all'){
		    $posts = Post::with('blog')->where('post_timestamp' , '>' , $targetTimeStamp )->where('post_tags','like', "%$channel%")->orderBy('posts.post_socialScore','desc')->take(5)->remember(3)->get();
		  }else{
		    $posts = Post::with('blog')->where('post_timestamp' , '>' , $targetTimeStamp )->orderBy('posts.post_socialScore','desc')->take(5)->remember(3)->get();
		  }
		  return $posts;
		}
	}

?>