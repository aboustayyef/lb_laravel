<?php

class MobileAjaxController extends BaseController
{

 /*******************************************************************
 *	This function ads additional posts to the page through ajax.
 *
 ********************************************************************/
  function index($channel = 'all', $from=0, $howmany=10){

    $posts =  Post::getPosts($channel, $from, $howmany);
    return View::make('mobile.setOfPosts')->with(['posts'  =>  $posts, 'isBlogger'  => false]);
  }

/*******************************************************************
 *  Same but for bloggers
 *
 ********************************************************************/
  function bloggerIndex($nameId = 'lebaneseBlogs', $from=0, $howmany=10){

    $posts =  Post::getPostsByBlogger($nameId, $from, $howmany);

    return View::make('mobile.setOfPosts')->with(['posts'  =>  $posts, 'isBlogger'  => true]);
  }

}
