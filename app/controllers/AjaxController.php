<?php

class AjaxController extends BaseController
{

 /*******************************************************************
 *	This function ads additional posts to the page through ajax.
 *
 ********************************************************************/
  function loadMorePosts(){
    // later will set the values below from session
    $amount = 20;
    $from = Session::get('postsCounter');

    $posts = Page::getPosts($from, $amount);
    return View::make('posts.render')->with(['posts'  =>  $posts]);
  }

/*******************************************************************
* This Function returns a JSON object with top 5 posts
*
********************************************************************/
    function loadTopFivePosts(){
      $hours = Input::Get('hours');
      return View::Make('posts.extras.toplist')->with('hours',$hours);
    }
}
