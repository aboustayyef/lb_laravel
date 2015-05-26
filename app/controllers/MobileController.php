<?php
  /**
  *
  */
  class MobileController extends BaseController
  {

    /*
    *   This function displays our initial rendering of posts
    */

    function index($channel="all"){


        // 1- $channel is a child resolve it to its parent channel;
        $canonicalChannel = Channel::resolveTag($channel);

        // 2- if we have a subchannel, redirect to main channel
        if ($canonicalChannel != $channel) {
          return Redirect::to('posts/mobile/'.$canonicalChannel);
        }

        // get recent posts

        if (!Cache::has('mobileRecentPosts'.$channel)) {
          Cache::put('mobileRecentPosts'.$channel, Post::getPosts($channel, 0, 8), 9);
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

        $recentPosts = Cache::get('mobileRecentPosts'.$channel);
        $topPosts = Cache::get('mobileTopPosts');

        Return View::Make('mobile.index')->with(['recentPosts'=>$recentPosts, 'topPosts'=>$topPosts, 'channel'=>$channel]);
    }
}
