<?php

class MobileAjaxController extends BaseController
{

 /*******************************************************************
 *	This function ads additional posts to the page through ajax.
 *
 ********************************************************************/
  function index($from=0, $howmany=10){

    $posts =  Post::getPosts('all', $from, $howmany);
    return View::make('mobile.setOfPosts')->with(['posts'  =>  $posts]);
  }

}
