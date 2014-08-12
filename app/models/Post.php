<?php

class Post extends Eloquent{

  protected $primaryKey = 'post_id';
  public $timestamps = false;

  public function blog(){
    return $this->belongsTo('Blog');
  }

  public function columnist(){
    return $this->belongsTo('Columnist');
  }

/*
|--------------------------------------------------------------------------
| Interval Getter
|--------------------------------------------------------------------------
| A general function to get posts from an interval
*/

  public static function getPosts($channel='all', $from=0, $amount=20){
    if (isset($channel) && $channel != 'all') {
      $posts = DB::table('posts')
      ->leftJoin('blogs', 'posts.blog_id', '=', 'blogs.blog_id')
      ->leftJoin('columnists', 'posts.blog_id', '=', 'columnists.col_shorthand')
      ->where('columnists.col_tags', 'like', '%' . $channel . '%')
      ->orwhere('blogs.blog_tags', 'like', '%' . $channel . '%')
      ->orderBy('posts.post_timestamp','desc')
      ->skip($from)->take($amount)
      ->remember(5)
      ->get();
    }else{
      $posts = DB::table('posts')
      ->leftJoin('blogs', 'posts.blog_id', '=', 'blogs.blog_id')
      ->leftJoin('columnists', 'posts.blog_id', '=', 'columnists.col_shorthand')
      ->orderBy('posts.post_timestamp','desc')
      ->skip($from)->take($amount)
      ->remember(5)
      ->get();
    }

    // harmonize results
    $posts = self::harmonise($posts);
    return $posts;
  }

/*
|--------------------------------------------------------------------------
| Special Case Interval Getter
|--------------------------------------------------------------------------
| Just gets the latest posts
*/

  public static function getLatest($channel){
    return self::getPosts($channel, 0, 20);
  }


/*
|--------------------------------------------------------------------------
| Latest Top Posts Getter
|--------------------------------------------------------------------------
| Gets Top Posts based on a timeframe
*/

  public static function getTopPosts($channel='all', $hours=12){
    $seconds = $hours * 60 * 60;
    if (isset($channel) && $channel != 'all') {
      $posts = DB::table('posts')
      ->leftJoin('blogs', 'posts.blog_id', '=', 'blogs.blog_id')
      ->leftJoin('columnists', 'posts.blog_id', '=', 'columnists.col_shorthand')
      ->where('posts.post_timestamp','>', time()-$seconds)
      ->where(function($query) use ($channel){ // we use 'use' to pass variables to a closure
        $query->where('columnists.col_tags', 'like', '%' . $channel . '%')
              ->orwhere('blogs.blog_tags', 'like', '%' . $channel . '%');
      })
      ->orderBy('posts.post_socialScore','desc')
      ->take(5)
      ->remember(5)
      ->get();
    }else{
      $posts = DB::table('posts')
      ->leftJoin('blogs', 'posts.blog_id', '=', 'blogs.blog_id')
      ->leftJoin('columnists', 'posts.blog_id', '=', 'columnists.col_shorthand')
      ->where('posts.post_timestamp','>', time()-$seconds)
      ->orderBy('posts.post_socialScore','desc')
      ->take(5)
      ->remember(5)
      ->get();
    }

    // harmonize results
    $posts = self::harmonise($posts);
    return $posts;
  }
/*
|--------------------------------------------------------------------------
| Get Posts From Blogger
|--------------------------------------------------------------------------
|
*/

public static function getPostsByBlogger($bloggerId, $from, $howmany){
  $posts = Post::Where('blog_id', $bloggerId)->skip($from)->orderBy('posts.post_timestamp','desc')->take($howmany)->get();
  // harmonize results
  $posts = self::harmonise($posts);
  return $posts;
}

public static function getTopPostsByBlogger($bloggerId){
  $posts = Post::Where('blog_id', $bloggerId)->orderBy('posts.post_virality','desc')->take(5)->get();
  $posts = self::harmonise($posts);
  return $posts;
}

/*
|--------------------------------------------------------------------------
| Results Harmoniser
|--------------------------------------------------------------------------
| This general function makes sure that the results are standardised between
| Bloggers and columnists
*/

  public static function harmonise($input = array())
  {
    $output = array();
    foreach ($input as $key => $post)
    {
        if (empty($post->blog_id)) {
            $post->blog_id = $post->col_shorthand ;
            $post->blog_author_twitter_username = $post->col_author_twitter_username ;
            $post->blog_name = $post->col_name ;
            // optional
            if (!empty($post->col_description)) {
                $post->blog_description = $post->col_description;
            }
            if (!empty($post->col_tags)) {
                $post->blog_tags = $post->col_tags;
            }
            if (!empty($post->col_home_page)) {
                $post->blog_url = $post->col_home_page;
            }
        }
        array_push($output, $post);
    }
    return $output;
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
