<?php 

class Post extends Eloquent{

  protected $primaryKey = 'post_id';
  public $timestamps = false;

  public function blog(){
    return $this->belongsTo('Blog');
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
      ->orderBy('posts.post_virality','desc')
      ->take(5)
      ->remember(5)
      ->get();        
    }else{
      $posts = DB::table('posts')
      ->leftJoin('blogs', 'posts.blog_id', '=', 'blogs.blog_id')
      ->leftJoin('columnists', 'posts.blog_id', '=', 'columnists.col_shorthand')
      ->where('posts.post_timestamp','>', time()-$seconds)
      ->orderBy('posts.post_virality','desc')
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
}