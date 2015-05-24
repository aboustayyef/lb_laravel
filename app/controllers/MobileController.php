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
          $howManyTopPosts = 0;
          $hours = 12;
          while ( $howManyTopPosts < 5) {
            $topPostsCandidates = Post::getTopPosts('all', $hours);
            $howManyTopPosts = count($topPostsCandidates);
            $hours *= 2;
          }

          Cache::put('mobileTopPosts', $topPostsCandidates, 9);
        }

        $recentPosts = Cache::get('mobileRecentPosts');
        $topPosts = Cache::get('mobileTopPosts');

        Return View::Make('mobile.index')->with(['recentPosts'=>$recentPosts, 'topPosts'=>$topPosts]);
    }
}
