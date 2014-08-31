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

      // If this is a blogger's page, return more of that blogger's posts
      $pageKind = Session::get('pageKind');
      if ((!empty($pageKind)) && ($pageKind == 'blogger')) {
        $blogger = Session::get('blogger');
        $posts = Post::getPostsByBlogger($blogger, $from, $amount);

      // If this is a favorites page, return more posts from favorite blogs

      } elseif  ($pageKind == 'favorites'){
        $posts = Post::getFavoritePosts(Session::get('lb_user_id'), $from, $amount);
      // Otherwise return everything
      } elseif  ($pageKind == 'search'){
        return Null;
      // Otherwise return everything
      } else {
        // otherwise, return the normal stuff
        $channel = Session::get('channel');
        $posts = Post::getPosts($channel, $from, $amount);
      }
      if ($posts) {
        return View::make('posts.render')->with(array(
          'posts'=>$posts ,
          'from'=>$from,
          'to'=>$from + $amount));
      } else {
        return '';
      }

    }

/*******************************************************************
* This Function returns a JSON object with top 5 posts
*
********************************************************************/
    function loadTopFivePosts(){
      $hours = Input::Get('hours');
      return View::Make('posts.extras.toplist')->with('hours',$hours);
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
