<?php
/**
*
*/
class User extends Eloquent
{
  // use new users table to avoid conflict when moving to new version
  protected $table = 'users_new';
  protected $primaryKey = 'user_id';

/*
|---------------------------------------------------------------------
|   Get details of signed in user
|---------------------------------------------------------------------
|
|   If a user is signed in, there will be a cookie with their id number
|   This method will return the user's details or false if not found
*/

  public static function cookieExists(){
    if (Cookie::get('lbUserId')) {
      $uid = Cookie::get('lbUserId');
      $user = User::find($uid);
      if ($user) {
        return $user;
      }
      return false;
    }
  }

/*
|---------------------------------------------------------------------
|   Create New User from array of values
|---------------------------------------------------------------------
*/
  public static function createNew($details){
    $user = new User;
    $user->user_email = $details['email'];
    $user->user_provider = $details['provider'];
    $user->user_provider_id = $details['provider_id'];
    $user->user_gender = $details['gender'];
    $user->save();
    Cookie::queue('lbUserId', $user->user_id, 60*24*30);
  }

/*
|---------------------------------------------------------------------
|   Get posts saved by user
|---------------------------------------------------------------------
|
|   Returns a list of urls of posts saved by user.
|   If $comprehensive is set to true, method will return all
|   post details,
|
*/
  public function savedPosts($comprehensive = false){
    $listOfPostUrls = DB::table('users_posts')->where('user_id','=',$this->user_id)->lists('post_url');
    if ($comprehensive) {
      $posts = DB::table('posts')->whereIn('post_url', $listOfPostUrls)->get();
      return $posts;
    }
    return $listOfPostUrls;
  }

/*
|---------------------------------------------------------------------
|   Get list of favorited bloggers
|---------------------------------------------------------------------
|
| Provides a list of blogs favorited by user. If $comprehensive
| is set to true it will returns all blog details
|
*/
  public function favoritedBlogs($comprehensive = false){
    $listOfBlogIds = DB::table('users_blogs')->where('user_id','=',$this->user_id)->lists('blog_id');
    if ($comprehensive) {
      $blogs = DB::table('blogs')->whereIn('blog_id', $listOfBlogIds)->get();
      return $blogs;
    }
    return $listOfBlogIds;
  }

  /*
  |---------------------------------------------------------------------
  |   Get latest posts by favorited blogs
  |---------------------------------------------------------------------
  |   Returns a list of posts from favorite bloggers
  |
  */
  public function latestPostsByFavoriteBlogs($from = 0, $to = 20){
    $listOfBlogIds = $this->favoritedBlogs();
    $posts = DB::table('posts')->whereIn('blog_id', $listOfBlogIds)->skip($from)->take($to)->get();
    return $posts;
  }


  /*
  |--------------------------------------------------------------------------
  | Find out if blog is favorited by user
  |--------------------------------------------------------------------------
  | return true if a blog is favorited by user
  */

  public function hasFavoriteBlog($blogId){
    if (DB::table('users_blogs')->where('user_id',$this->user_id)->where('blog_id', $blogId)->count() > 0) {
      return true;
    }
    return false;
  }


  /*
  |--------------------------------------------------------------------------
  | Find out if post is saved by user
  |--------------------------------------------------------------------------
  | return true if a post is saved by user
  */

  public function hasSavedPost($postUrl){
    if (DB::table('users_posts')->where('user_id',$this->user_id)->where('post_url', $postUrl)->count() > 0) {
      return true;
    }
    return false;
  }
}
