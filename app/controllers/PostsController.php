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
      if ($channel == 'search'){
        $query = Input::get('q');
        if (empty($query)) {
          // if no parameters, forward back to home page
          return Redirect::to('/posts/all');
        }else{
          // initialize posts counters
          Session::put('postsCounter', 0);
          Session::put('cardsCounter', 0);
          Session::put('pageKind', 'searchResults');
          Session::put('searchQuery', stripcslashes($query));
          return View::make('posts.main');
        }
      }

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

      $view = str_contains(Request::path(),'mobile') ? 'mobile2.index' : 'posts.main';

      return View::make( $view )->with([
        'initialPosts'      => $initialPosts,
        'pageTitle'         => $pageTitle,
        'pageDescription'   => $pageDescription
      ]);
    }

}
