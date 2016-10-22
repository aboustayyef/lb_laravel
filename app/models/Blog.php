<?php
  class Blog extends Eloquent
  {
    protected $fillable = ['blog_name','blog_description', 'blog_author', 'blog_tags'];
    protected $primaryKey = 'blog_id';
    public $timestamps = true;

    public function posts(){
      return $this->hasMany('Post');
    }

    public function users(){
      return $this->belongsToMany('User');
    }

    public function followers(){
      return $this->users->count();
    }

    public static function exists($blogId){
      $blog = self::where('blog_id', $blogId)->first();
      if (is_object($blog)) {
        return true;
      }
      return false;
    }

    public static function existsByName($blogName){
      $blog = self::where('blog_name', $blogName)->first();
      if (is_object($blog)) {
        return $blog->blog_id;
      }
      return false;
    }

    public function stats()
    {
      return (new \LebaneseBlogs\Utilities\BlogStatsGetter($this))->get();
    }

    public function owner(){
      // return the user id of the blog's owner
      $twitter = $this->blog_author_twitter_username;
      $user = User::where('twitter_username', $twitter)->first();
      if ($user->exists) {
        return $user->id;
      }else{
        return false;
      }
    }

    public function hasChannel($channel){
      $channels = array_map('trim', explode(',' , $this->blog_tags));
      return in_array($channel, $channels);
    }

    public function editUpdate($newDetails){
      $this->blog_name = $newDetails['name'];
      $this->blog_description = $newDetails['description'];
      try {
        $this->save();
        return true;
        #success
      } catch (Exception $e) {
        return false;
      }
    }

    public function isActive()
    {
      return $this->blog_RSSCrawl_active == 1;
    }

    public function deactivate($reason="no reason given"){
      $this->blog_RSSCrawl_active=0;
      $this->reason_for_deactivation=$reason;
      $this->save();
    }

    public function deactivateAndDeletePosts($reason="no reason given"){
      $this->deactivate($reason);
      $this->posts->each(function($post){
        $post->delete();
        echo PHP_EOL . "Post [$post->post_title] deleted" ;
      });
    }

    static function validate($input){
      $rules = [
        'blog_name'  =>  'required|min:5',
        'blog_description' =>  'required|min:15|max:150',
      ];

      $validator = Validator::make($input, $rules);
      if ($validator->fails()) {
        return $validator->messages();
      } else {
        return 'ok';
      }
    }

    static function store($blogId, $input){
      
      $blog = Blog::where('blog_id',$blogId)->get()->first();

      // convert blog_tags from array to comma delimited
      if (is_array($input['blog_tags'])) {
          $input['blog_tags'] = implode(',', $input['blog_tags']);
      }
      $input = array_map('trim', $input);
    
      $blog->fill($input);
      $blog->save();
      return true;
    }
    
  }
