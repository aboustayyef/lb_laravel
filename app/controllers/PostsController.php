<?php
  /**
  *
  */
  class PostsController extends BaseController
  {

    /*
    *   This function displays our initial rendering of posts
    */

    function index($channel='all', $action=null){

      // 1- $channel is a child resolve it to its parent channel;
      $canonicalChannel = Channel::resolveTag($channel);

      // 2- if we have a subchannel, redirect to main channel
      if ($canonicalChannel != $channel) {
        return Redirect::to('posts/'.$canonicalChannel);
      }

      // set pageKind & channel sessions

      Session::put('channel', $canonicalChannel);
      if ($canonicalChannel == 'all') {
        Session::put('pageKind', 'allPosts');
      } else {
        Session::put('pageKind', 'channel');
      }

      // initialize posts counters
      Session::put('postsCounter', 0);
      Session::put('cardsCounter', 0);

      // initialize metadata and initial posts
      $initialPosts = Page::getPosts();
      $pageTitle = Page::getTitle();
      $pageDescription = Page::getDescription();

      return View::make('posts.main')->with([
        'initialPosts'      => $initialPosts,
        'pageTitle'         => $pageTitle,
        'pageDescription'   => $pageDescription
      ]);
    }

}
