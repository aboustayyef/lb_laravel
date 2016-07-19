<?php
  class Blog extends Eloquent
  {
    protected $fillable = ['blog_name','blog_description', 'blog_author'];
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
        'name'  =>  'required|min:5',
        'description' =>  'required|min:15|max:150',
        'image'   =>  'image|max:150'
      ];

      $validator = Validator::make($input, $rules);
      if ($validator->fails()) {
        return $validator->messages();
      } else {
        return 'ok';
      }
    }
  }
