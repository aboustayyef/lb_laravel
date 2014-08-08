<?php
  /**
  *
  */
  class PostsController extends BaseController
  {

    /*
    *   This function displays our initial rendering of posts
    */

    function show($channel){
      // 1- First resolve the tag to make sure
      // the channel exists
      $canonicalChannel = Channel::resolveTag($channel);

      // 2- if we have a subchannel, redirect to main channel
      if ($canonicalChannel != $channel) {
        return Redirect::to('posts/'.$canonicalChannel);
      }
      $channelDescription = Channel::description($canonicalChannel);

      // set session for channel. Necessary for ajax calls;
      Session::put('channel', $canonicalChannel);
      Session::put('pageKind', 'general');

      $pageTitle = ($canonicalChannel == 'all') ? "Lebanese Blogs | Latest posts from the best Blogs" : "Lebanese Blogs | $channelDescription ";
      $pageDescription = ($canonicalChannel == 'all') ? "The best place to discover, read and organize Lebanon's top blogs" : "Lebanon's top blogs about $channelDescription";

      $posts = Post::getLatest($canonicalChannel);
      return View::make('posts.main')->with(array(
        'pageTitle'=>$pageTitle,
        'pageDescription'=> $pageDescription,
        'posts'=>$posts ,
        'from'=>0,
        'to'=>20));
    }
}
