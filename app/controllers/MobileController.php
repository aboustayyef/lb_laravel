<?php
  /**
  *
  */
  class MobileController extends BaseController
  {

    /*
    *   This function displays our initial rendering of posts
    */

    function index($set="posts", $detail="all"){
        if ($set == "posts") {
          return $this->mobilePosts($detail);
        }else if ($set == "blogger"){
          return $this->mobileBlogger($detail);
        }else{
          return $this->mobilePosts('all');
        }

    }

  function mobilePosts($channel="all"){
        // 1- $channel is a child resolve it to its parent channel;
        $canonicalChannel = Channel::resolveTag($channel);

        // 2- if we have a subchannel, redirect to main channel
        if ($canonicalChannel != $channel) {
          return Redirect::to('/mobile/posts/'.$canonicalChannel);
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

        Return View::Make('mobile.index')->with(['recentPosts'=>$recentPosts, 'topPosts'=>$topPosts, 'channel'=>$channel, 'isBlogger'=>false]);

  }

  function mobileBlogger($nameId="lebaneseblogs"){
      if (!Blog::find($nameId)) { // blog doesn't exist
        return Redirect::to('/mobile/posts/');
      }

      $recentPosts = Post::getPostsByBlogger($nameId, 0, 8);
       Return View::Make('mobile.index')->with(['recentPosts'=>$recentPosts, 'isBlogger'=>true, 'whichBlog'=>$nameId]);
  }
}
