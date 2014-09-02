<?php
/**
*
*/
class User extends Eloquent
{
  // use new users table to avoid conflict when moving to new version
  protected $table = 'new_users';
  public $timestamps = false;

  /*
  |--------------------------------------------------------------------------
  | Find out if a user is logged in
  |--------------------------------------------------------------------------
  | usage: if User::signedIn() proceed
  */

  public static function signedIn(){

    // check session
    if (Session::has('lb_user_id')) {
      return Session::get('lb_user_id');
    }

    // check cookie
    if (Cookie::has('lb_user_id')) {
      return Cookie::get('lb_user_id');
    }

    // if none of those exists
    return false;
  }

  public function blogs(){
      return $this->belongsToMany('Blog');
  }

  public function posts(){
      return $this->belongsToMany('Post');
  }

/*
|---------------------------------------------------------------------
|   see if a blog belong to users' favorites
|---------------------------------------------------------------------
|
*/
  public function hasFavoriteBlog($blog_id){
    if (in_array($blog_id, $this->blogs->lists('blog_id'))) {
      return true;
    }
    return false;
  }

/*
|---------------------------------------------------------------------
|   returns amount of favorited blogs
|---------------------------------------------------------------------
|
*/
  public function howManyFavoritedBlogs(){
    return $this->blogs->count();
  }

/*
|---------------------------------------------------------------------
|   returns amount of saved posts
|---------------------------------------------------------------------
|
*/
  public function howManySavedPosts(){
    return $this->posts->count();
  }


/*
|---------------------------------------------------------------------
|   see if a blog belong to users' favorites
|---------------------------------------------------------------------
|
*/
  public function hasSavedPost($post_id){
    if (in_array($post_id, $this->posts->lists('post_id'))) {
      return true;
    }
    return false;
  }


/*
|---------------------------------------------------------------------
|   Get posts saved by user
|---------------------------------------------------------------------
|
|   Returns a list of urls of posts saved by user.
|   If $comprehensive is set to true, method will return all
|   post details,
|
*/
  public function savedPosts($comprehensive = false){
    $listOfPostUrls = DB::table('users_posts')->where('user_id','=',$this->user_id)->lists('post_url');
    if ($comprehensive) {
      $posts = DB::table('posts')->whereIn('post_url', $listOfPostUrls)->get();
      return $posts;
    }
    return $listOfPostUrls;
  }


  public function profileImage(){
      $img = $this->image_url;
      if (!empty($img)) {
        return $img;
      }else{
        return asset('/img/placeholder_profile_pic.png');
      }
  }

  public function firstName(){
    $firstName = $this->first_name;
    if (!empty($firstName)) {
      return $firstName;
    }else{
      return '';
    }
  }

  /*
  |--------------------------------------------------------------------------
  | Process the data provided by login provider log in
  |--------------------------------------------------------------------------
  | 1 - if user exists, see if missing records (temporary untill all records are full).
  | 2 - if user doesn't exist create user
  | 3 - set up cookie
  | 4 - if there is an intended page, go there, otherwise
  */

  public static function processProviderData($userDetails){

    // if user exists;
    if (User::where('provider',$userDetails['provider'])->where('provider_id',$userDetails['providerId'])->count() > 0 ){

      //select user
      $user = User::where('provider',$userDetails['provider'])->where('provider_id',$userDetails['providerId'])->first();

    }else{
      $user = new User;
    }
    // in any case, fill the data
    $user->provider = $userDetails['provider'];
    $user->provider_id = $userDetails['providerId'];
    $user->first_name = $userDetails['firstName'];
    $user->last_name = $userDetails['lastName'];
    $user->email_address = $userDetails['email'];
    $user->gender = $userDetails['gender'];
    $user->updated_timestamp = time();
    $user->last_visit_timestamp = time();
    $user->image_url = $userDetails['imageUrl'];
    $user->visit_count = $user->visit_count + 1;
    $user->save();

    Session::put('lb_user_id', $user->id);
    if (Session::has('finalDestination')) {
      return Redirect::action(Session::get('finalDestination'));
    } else {
      return Redirect::to('posts/all');
    }
  }
}
