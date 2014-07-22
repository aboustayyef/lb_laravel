<?php
  class Blog extends Eloquent
  {
    protected $primaryKey = 'blog_id';
    public $timestamps = false;

    public function posts(){
      return $this->hasMany('Post');
    }
  }