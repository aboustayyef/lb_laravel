<?php
  /**
  *
  */
  class AllPostsController extends BaseController
  {

    /*
    *   This function displays our initial rendering of posts
    */

    function index(){

      // set pageKind & channel sessions
      Session::put('channel', 'all');
      Session::put('pageKind', 'allPosts');

      // initialize posts counters
      Session::put('postsCounter', 0);
      Session::put('cardsCounter', 0);

      // initialize metadata and initial posts
      $pageTitle = 'Lebanese Blogs | Latest Posts from the Best Blogs and Vlogs';
      $pageDescription = 'The best place to discover Lebanon\'s top blogs and vlogs';

      $initialPosts = Post::getPosts('all', 0, 20);

      return View::make('posts.main')->with([
        'initialPosts'      => $initialPosts,
        'pageTitle'         => $pageTitle,
        'pageDescription'   => $pageDescription
      ]);
    }

}
