<?php

class Post extends Eloquent{

  protected $primaryKey = 'post_id';
  public $timestamps = false;

  public function blog(){
    return $this->belongsTo('Blog');
  }


public static function getPosts($channel='all', $from=0, $amount=20){
  if (isset($channel) && $channel != 'all'){
    $posts = Post::with('blog')->where('post_tags','like', "%$channel%")->orderBy('post_timestamp','desc')->skip($from)->take($amount)->remember(3)->get();
  }else{
    $posts = Post::with('blog')->orderBy('post_timestamp','desc')->skip($from)->take($amount)->remember(3)->get();
  }
  return $posts;
}

public static function getTopPosts($channel='all', $hours=12){
  $targetTimeStamp = time() - ( $hours * 60 * 60 );
  if (isset($channel) && $channel != 'all'){
    $posts = Post::with('blog')->where('post_timestamp' , '>' , $targetTimeStamp )->where('post_tags','like', "%$channel%")->orderBy('posts.post_socialScore','desc')->take(5)->remember(3)->get();
  }else{
    $posts = Post::with('blog')->where('post_timestamp' , '>' , $targetTimeStamp )->orderBy('posts.post_socialScore','desc')->take(5)->remember(3)->get();
  }
  return $posts;
}

/*
|--------------------------------------------------------------------------
| get favorite posts interval
|--------------------------------------------------------------------------
| gets an interval of posts from favorite bloggers
*/

public static function getFollowedPosts($from=0, $amount=20){
  $userID = User::signedIn();
  $user = User::find($userID);
  $listOfBlogIds = $user->blogs->lists('blog_id');
  if (count($listOfBlogIds) == 0) { // no favorited blogs
    return false;
  }
  $posts = Post::with('blog')->whereIn('blog_id', $listOfBlogIds)
          ->orderBy('post_timestamp','desc')
          ->skip($from)->take($amount)->remember(3)->get();
  return $posts;
}

/*
|--------------------------------------------------------------------------
| get Saved posts interval
|--------------------------------------------------------------------------
| gets an interval of posts from Saved Posts
*/

public static function getSavedPosts($from=0, $amount=20){
  $userID = User::signedIn();
  $user = User::find($userID);
  $listOfPostIds = $user->posts->lists('post_id');
  if (count($listOfPostIds) == 0) { // no saved posts
    return false;
  }
  $posts = Post::with('blog')->whereIn('post_id', $listOfPostIds)
          ->orderBy('post_timestamp','desc')
          ->skip($from)->take($amount)->remember(3)->get();
  return $posts;
}


/*
|--------------------------------------------------------------------------
| Special Case Interval Getter
|--------------------------------------------------------------------------
| Just gets the latest posts
*/

  public static function getLatest($channel){
    return Post::getPosts($channel, 0, 20);
  }

/*
|--------------------------------------------------------------------------
| Get Posts From Blogger
|--------------------------------------------------------------------------
|
*/

public static function getPostsByBlogger($bloggerId, $from, $howmany){
  $blog = Blog::find($bloggerId);
  $posts = Post::with('blog')->where('blog_id',$blog->blog_id)->orderBy('posts.post_timestamp','desc')->skip($from)->take($howmany)->remember(3)->get();
  return $posts;
}

public static function getTopPostsByBlogger($bloggerId){
  $posts = Post::with('blog')->where('blog_id', $bloggerId)->orderBy('posts.post_virality','desc')->take(5)->remember(3)->get();
  return $posts;
}

  /*
  |--------------------------------------------------------------------------
  | Returns Cached Image Location (if any)
  |--------------------------------------------------------------------------
  | This method returns the location of a post's cached image;
  | if it doesn't find any, it returns false
  */

  public function cacheImage(){
    $cachedImageFilename = $this->post_timestamp.'_'.$this->blog_id.'.jpg';
    $cachedImage = $_ENV['DIRECTORYTOPUBLICFOLDER'].'/img/cache/'.$this->post_timestamp.'_'.$this->blog_id.'.jpg'; // if exists
    if (file_exists($cachedImage)) {
      return asset('/img/cache/'.$cachedImageFilename);
    } else {
      return FALSE;
    }
  }

  /*
  |--------------------------------------------------------------------------
  | Returns whether or not a post has an image (true or false)
  |--------------------------------------------------------------------------
  */

  public function hasImage(){
    if ($this->post_image_height > 0 ) {
      return true;
    } else {
      return FALSE;
    }
  }

}
