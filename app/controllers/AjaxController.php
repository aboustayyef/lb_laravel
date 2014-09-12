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

    $posts = Page::getPosts($from, 20);
    return View::make('posts.render')->with(['posts'  =>  $posts]);
  }
}
