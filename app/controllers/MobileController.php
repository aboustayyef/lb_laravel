<?php
  /**
  *
  */
  class MobileController extends BaseController
  {

    /*
    *   This function displays our initial rendering of posts
    */

    function index(){

        // get recent posts

        if (!Cache::has('mobileRecentPosts')) {
          Cache::put('mobileRecentPosts', Post::getPosts('all', 0, 16), 9);
        }

        if (!Cache::has('mobileTopPosts')) {
          Cache::put('mobileTopPosts', Post::getTopPosts('all', 12), 9);
        }

        $recentPosts = Cache::get('mobileRecentPosts');
        $topPosts = Cache::get('mobileTopPosts');

        Return View::Make('mobile.index')->with(['recentPosts'=>$recentPosts, 'topPosts'=>$topPosts]);
    }
}
