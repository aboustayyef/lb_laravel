<?php 
  /**
  * 
  */
  class ShowPosts extends BaseController
  {
    
    /*
    *   This function displays our initial rendering of posts
    */

    function display($channel){
      // 1- First resolve the tag to make sure
      // the channel exists 
      $canonicalChannel = Channel::resolveTag($channel);
      
      // 2- if we have a subchannel, redirect to main channel
      if ($canonicalChannel != $channel) {
        return Redirect::to('posts/'.$canonicalChannel);
      }
      // set session for channel
      Session::put('channel', $canonicalChannel);

      $posts = Post::getLatest($canonicalChannel);
      return View::make('posts.main')->with(array(
        'posts'=>$posts , 
        'from'=>0, 
        'to'=>20));
    }
}