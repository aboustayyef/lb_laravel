<?php
  /**
  *
  */
  class ChannelPostsController extends BaseController
  {

    /*
    *   This function displays our initial rendering of posts
    */

    function index($channel){

      // 1- $channel is a child resolve it to its parent channel;
      $canonicalChannel = Channel::resolveTag($channel);

      // 2- if we have a subchannel, redirect to main channel
      if ($canonicalChannel != $channel) {
        return Redirect::to('posts/'.$canonicalChannel);
      }

      // set pageKind & channel sessions
      Session::put('channel', $canonicalChannel);
      Session::put('pageKind', 'channel');


      // initialize posts counters
      Session::put('postsCounter', 0);
      Session::put('cardsCounter', 0);

      // initialize metadata and initial posts
      $pageTitle = "Top " . Channel::description($canonicalChannel) . " blogs and vlogs in Lebanon | Lebanese Blogs";
      $pageDescription = $pageTitle;

      $initialPosts = Post::getPosts($canonicalChannel, 0, 20);

      return View::make('posts.main')->with([
        'initialPosts'      => $initialPosts,
        'pageTitle'         => $pageTitle,
        'pageDescription'   => $pageDescription
      ]);
    }

}
