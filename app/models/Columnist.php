<?php
  class Columnist extends Eloquent
  {
    protected $primaryKey = 'col_shorthand';
    public $timestamps = false;

    public function posts(){
      return $this->hasMany('Post');
    }
  }