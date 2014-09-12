<?php
  class Blog extends Eloquent
  {
    protected $primaryKey = 'blog_id';
    public $timestamps = false;

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
  }
