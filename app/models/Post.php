<?php

class Post extends Eloquent{

  protected     $primaryKey = 'post_id';
  public        $timestamps = true;
  protected     $fillable   = ['post_title', 'rating_denominator', 'rating_numerator', 'post_tags'];


  public function blog(){
    return $this->belongsTo('Blog');
  }

  public function carbonDate(){
    return \Carbon\Carbon::createFromTimestamp($this->post_timestamp);
  }

  public function exitLink(){
    $exitLink = '/exit?url='.urlencode($this->post_url).'&token='.Session::get('_token'); 
    return $exitLink;
  }

  public function image(){ 
    return new PostImage($this);
  }
  
  public static function getPosts($channel='all', $from=0, $amount=20){
    if (isset($channel) && $channel != 'all'){
      $posts = Post::with('blog')->where('post_tags','like', "%$channel%")->orderBy('post_timestamp','desc')->skip($from)->take($amount)->remember(3)->get();
    }else{
      $posts = Post::with('blog')->orderBy('post_timestamp','desc')->skip($from)->take($amount)->remember(3)->get();
    }
    return $posts;
  }

  public static function topPosts(){
    $temp = new \LebaneseBlogs\Utilities\TopPostsGetter;
    return $temp->get();
  }

  public static function getTopPosts($channel='all', $hours=12){
    return (new \LebaneseBlogs\Utilities\TopPostsGetter)->getTopPosts($channel, $hours);
  }

  public function tweetLink(){
    $byline = $this->blog->blog_author_twitter_username ? " by @" . $this->blog->blog_author_twitter_username : "";
    $byline .= " via lebaneseblogs.com";
    $allowedTitleSize = 140 - strlen($byline) - 47;
    $byline = ' ' . $this->post_url . $byline;
    $postTitle = str_limit($this->post_title, $allowedTitleSize);
    $tweetExpression = $postTitle.$byline;
    $twitterUrl = urlencode($tweetExpression);
    return "https://twitter.com/intent/tweet?text=$twitterUrl";
  }

  public function hasRating(){
    return (($this->rating_denominator > 0) && ($this->rating_numerator > 1));
  }

  public static function getPostsByBlogger($bloggerId, $from, $howmany){
    $blog = Blog::find($bloggerId);
    $posts = Post::with('blog')->where('blog_id',$blog->blog_id)->orderBy('posts.post_timestamp','desc')->skip($from)->take($howmany)->remember(3)->get();
    return $posts;
  }

  public function cacheImage(){
    if (strlen($this->post_local_image) > 0) {
      if (app('env') == 'staging') {
        return 'https://static2.lebaneseblogs.com/'.$this->post_local_image . '.jpg';
      } else {
        return '/img/cache/' . $this->post_local_image . '.jpg';
      }
    } else {
      return FALSE;
    }
  }

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
