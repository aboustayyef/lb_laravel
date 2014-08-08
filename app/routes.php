<?php
use Symfony\Component\DomCrawler\Crawler ;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// Default route from root
Route::get('/', function(){
  if (Input::has('channel')) {
    return Redirect::to('/posts/'.Input::get('channel'));
  }
  return Redirect::to('posts/all');
});


// redirect outgoing links
Route::get('exit', array(
  'uses'  => 'ExitController@lbExit'
));

// handle urls, legacy and otherwise
Route::get('{slug}', ['uses'  =>  'UrlController@redirect']);

Route::get('posts/{channel?}', array(
  'as'=>'posts',
  'uses'=>'PostsController@show'
));

Route::get('/blogger/{nameId?}', array(
  'as'    =>  'blogger',
  'uses'  =>  'BloggerController@showPosts'
));

Route::get('/ajax/GetMorePosts', array(
  'uses'  =>  'AjaxController@loadMorePosts'
));

Route::get('/ajax/GetTop5', array(
  'uses'  =>  'AjaxController@loadTopFivePostsJson'
));




/*
|---------------------------------------------------------------------
|   Authentication Routes
|---------------------------------------------------------------------
|
|   Use to authenticate with third party providers
|
*/

Route::get('/auth/{provider}', array(
  'uses'  =>  'AuthenticationController@auth'
));

Route::get('/auth/{provider}/callback', array(
  'uses'  =>  'AuthenticationController@callback'
));

/*
|--------------------------------------------------------------------------
| Testing Routes
|--------------------------------------------------------------------------
|
| The posts here are for testing purposes only and are not used by the app
|
*/

Route::get('setTestCookie',function(){
  return Response::make('cookie Set', 200)->withCookie(Cookie::make('lbUserId', 25 , 300));
});

Route::get('userposts/{userid}', function($userid){
  $user = User::find($userid);
  $posts = $user->latestPostsByFavoriteBlogs();
  echo '<pre>',print_r($posts),'</pre>';
});

Route::get('testUser', function(){
  if (User::signedIn()) {
    echo '<pre>',print_r(User::signedIn()),'</pre>';
  }else{
    echo 'false';
  }
  //$mustapha = User::where('user_first_name','Makram')->first();
  //$mustaphaPosts = $mustapha->blogs(true);
  //echo '<pre>',print_r($mustaphaPosts),'</pre>';
});


// temporary route to import user records from old database table to new
Route::get('import',function(){
  $all = DB::table('users_blogs')->get();
  foreach ($all as $key => $relationship) {
    $facebookId = $relationship->user_facebook_id;
    $userId = DB::table('users_new')->where('user_provider_id', $facebookId)->pluck('user_id');

    DB::table('users_blogs')
            ->where('user_facebook_id', $facebookId)
            ->update(array('user_id' => $userId));
    echo $facebookId,' --> ',$userId,'<br>';
  }
});


Route::get('my/articles', ['uses' =>  'ArticlesFetcherController@getArticles']);

Route::get('test', function(){

  // testing dom crawling with symfony
  $html = file_get_contents('http://local.lebaneseblogs.com/test.html');
  $crawler = new Crawler($html);
  $nodeValues = $crawler->filter('.card .card_header')->each(function (Crawler $node, $i) {
    //echo '<pre>', print_r($node), '</pre>';
    return $node->html();
  });
  echo '<pre>', print_r($nodeValues), '</pre>';
});
