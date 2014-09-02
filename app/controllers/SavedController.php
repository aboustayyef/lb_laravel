<?php

/**
*
*/
class SavedController extends BaseController
{

  function __construct()
  {
    # nothing
  }

  public static function add($postId){
    $userId = User::signedIn();

    // if no user id (ie no one is signed in)
    if (!$userId) {
      return;
    }
    $ourUser = User::find($userId);

    $saves = DB::table('post_user')->where('post_id',$postId)->where('user_id',$userId)->count();

    // if not already favorited, add new record
    if ($saves == 0) {
      DB::table('post_user')->insert(
        array('post_id' => $postId, 'user_id' => $userId)
      );
    }
    //return Redirect::to('/posts/favorites');
  }

  public static function remove($postId){
    $userId = User::signedIn();

    // if no user id (ie no one is signed in)
    if (!$userId) {
      return;
    }

    // check if this blog is already favorited by that user
    $saves = DB::table('post_user')->where('post_id',$postId)->where('user_id',$userId)->count();

    // if already favorited, remove record
    if ($saves > 0) {
      DB::table('post_user')->where('post_id',$postId)->where('user_id',$userId)->delete();
    }
  }
}
