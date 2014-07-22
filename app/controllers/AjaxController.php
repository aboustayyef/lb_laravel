<?php 
/**
* 
*/
class AjaxController extends BaseController
{
	

   /*******************************************************************
   *	This function ads additional posts to the page through ajax.
   *
   ********************************************************************/ 
    function loadMorePosts(){
      // later will set the values below from session
      $amount = 20;
      $from = Input::Get('startFrom');
      $channel = Session::get('channel');

      $posts = Post::getPosts($channel, $from, $amount);
      return View::make('posts.render')->with(array(
        'posts'=>$posts , 
        'from'=>$from, 
        'to'=>$from + $amount));
    }


    /*******************************************************************
    *	This Function returns a JSON object with top 5 posts
    *
    ********************************************************************/ 
    function loadTopFivePostsJson(){
    	$hours = Input::Get('hours');
    	$channel = Session::get('channel');

    	$posts = Post::getTopPosts($channel, $hours);
    	
    	// if we don't have 5 results, we 
    	// keep doubling the hours until we get some
    	while ( count($posts) < 5) {
    		$hours = $hours * 2;
    		$posts = Post::getTopPosts($channel, $hours);
    	}
    	
    	$posts = json_encode($posts);
    	header('Content-Type: application/json');
    	echo $posts;
    }
}