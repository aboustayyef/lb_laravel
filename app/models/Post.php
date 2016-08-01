<?php

class Post extends Eloquent{

  protected $primaryKey = 'post_id';
  public $timestamps = true;
  protected $fillable = ['post_title', 'rating_denominator', 'rating_numerator', 'post_tags'];
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

public function carbonDate(){
  return \Carbon\Carbon::createFromTimestamp($this->post_timestamp);
}
// convenience functions;

public static function topPosts(){
  $temp = new \LebaneseBlogs\Utilities\TopPostsGetter;
  return $temp->get();
}

public function increaseCount(){
  $this->post_views = $this->post_views + 1;
  $this->save();
}

// Returns exit link for posts

public function exitLink(){
  $exitLink = '/exit?url='.urlencode($this->post_url).'&token='.Session::get('_token'); 
  return $exitLink;
}

// Generate Link to share a post on twitter

public function tweetLink()
{
  $byline = $this->blog->blog_author_twitter_username ? " by @" . $this->blog->blog_author_twitter_username : "";
  $byline .= " via lebaneseblogs.com";
  $allowedTitleSize = 140 - strlen($byline) - 47;
  $byline = ' ' . $this->post_url . $byline;
  $postTitle = str_limit($this->post_title, $allowedTitleSize);
  $tweetExpression = "New Top Post: " . $postTitle.$byline;
  $twitterUrl = urlencode($tweetExpression);
  return "https://twitter.com/intent/tweet?text=$twitterUrl";
}

public function hasRating()
{
  return (($this->rating_denominator > 0) && ($this->rating_numerator > 1));
}

// returns an image object
public function image(){
  
  $image = new \stdClass;
  
  // exists?
  if ($this->post_image_height > 0) {
    $image->exists = true;
  } else {
    $image->exists = false;
  }

  // source
  if ($this->cacheImage()) {
    $image->src = $this->cacheImage();
  } else {
    $image->src = $this->post_original_image;
  }

  // dimentions
  if ($this->cacheImage()) {
    $image->height = 165;
    $image->width = 300;
  } else {
    $image->height = $this->post_image_height;
    $image->width = $this->post_image_width;
  }

  if ($this->post_image_width > 0) {
    $image->ratio = $this->post_image_height / $this->post_image_width;
  } else {
    $image->ratio = false;
  }
  $image->horizontal = $this->post_image_width > $this->post_image_height;

  // background color
  $hue = $this->post_image_hue;
  $saturation = '20%';
  $luminosity = '85%';
  if ($hue == 0) {
    $saturation = '0%';
  }
  $image->background_color = "hsl($hue, $saturation, 75%)";

  return $image;
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



  /*
  |--------------------------------------------------------------------------
  | Returns Cached Image Location (if any)
  |--------------------------------------------------------------------------
  | This method returns the location of a post's cached image;
  | if it doesn't find any, it returns false
  */

  public function cacheImage(){
    if (strlen($this->post_local_image) > 0) {
      if (app('env') == 'staging') {
        return 'http://static2.lebaneseblogs.com/'.$this->post_local_image . '.jpg';
      } else {
        return '/img/cache/' . $this->post_local_image . '.jpg';
      }
    } else {
      return FALSE;
    }
  }
/**
 * Check if post exists
 */
  public static function exists($post_id){
    $post = self::where('post_id', $post_id)->first();
    if (is_object($post)) {
      return true;
    }
    return false;
  }

  public function hasChannel($channel){
    $channels = array_map('trim', explode(',' , $this->post_tags));
    return in_array($channel, $channels);
  }

  public static function getPostsFromSearchResults($from=0, $amount=20){
    $terms = Session::get('searchQuery');
    $results = $results = Post::with('blog')
      ->whereRaw("MATCH(post_title,post_content) AGAINST(? IN BOOLEAN MODE)", array($terms))
      ->orderBy('post_timestamp','desc')
      ->remember(1440)->get();
    if (count($results) > 0 ) {
      return $results;
    } else {
      return False;
    }

  }

  /*
  |--------------------------------------------------------------------------
  | Returns posts from search results
  |--------------------------------------------------------------------------
  */
  public static function getPostsFromElasticSearchResults($from=0, $amount=20){
    // all post Ids of result were stored in a session from PostController
    $all_results = Session::get('searchResults');
    if ( count( $all_results ) == 0 ) {
      return false;
    }
    $output_results = array();
    $subset_of_results = array_slice($all_results, $from, $amount);
    foreach ($subset_of_results as $key => $postId) {

      $output_results[] = Post::with('blog')->find($postId);
    }
    return $output_results;
  }

    public function editUpdate($newDetails){

      //prepare categories
      $categories = $newDetails['category1'];
      if (!empty($newDetails['category2'])) {
        $categories .= ' , ' . $newDetails['category2'];
      }

      $this->post_title = $newDetails['title'];
      $this->post_excerpt = $newDetails['excerpt'];
      $this->post_tags = $categories;
      $this->rating_numerator = $newDetails['rating'];
      $this->rating_denominator = 5;
      try {
        $this->save();
        return true;
        #success
      } catch (Exception $e) {
        return false;
      }
    }

    static function validate($input){
      $rules = [
        'post_title'  =>  'required|min:3',
        'rating_numerator'  =>  'numeric|between:1,10'
      ];

      $validator = Validator::make($input, $rules);
      if ($validator->fails()) {
        return $validator->messages();
      } else {
        return 'ok';
      }
    }

    static function store($postId, $input){
      $post = Post::where('post_id',$postId)->get()->first();

      // allow for nonexistent tags
      if (!isset($input['post_tags'])) {
        $input['post_tags'] = '';
      }
      // convert post_tags from array to comma delimited
      if (is_array($input['post_tags'])) {
          $input['post_tags'] = implode(',', $input['post_tags']);
      }

      // remove white space around tags
      $input = array_map('trim', $input);

      // sanitize rating and make it optional
      if (strlen(trim($input["rating_numerator"])) > 0) {
        $input["rating_numerator"] = intval($input["rating_numerator"]);
        $input["rating_denominator"] = 10;
      } else {
        $input["rating_numerator"] = null;
        $input["rating_denominator"] = null;
      }
    
      $post->fill($input);
      $post->save();
      return true;
    }

}
