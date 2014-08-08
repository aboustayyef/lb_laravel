<?php
  class Blog extends Eloquent
  {
    protected $primaryKey = 'blog_id';
    public $timestamps = false;

    public function posts(){
      return $this->hasMany('Post');
    }

    public static function exists($blogId){
      $blog = self::where('blog_id', $blogId)->first();
      if (is_object($blog)) {
        return true;
      }
      return false;
    }
  }
