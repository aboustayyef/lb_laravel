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
    // handles requests from old permalink structures like lebaneseblogs.com/?channel=fashion
    return Redirect::to('/posts/'.Input::get('channel'));
  }
  // otherwise, root redirects to all posts
  return Redirect::to('posts/all');
});


// redirect outgoing links, for exit link counting and registering
Route::get('exit', array(
  'uses'  => 'ExitController@lbExit'
));

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


//login page
Route::get('/login',function()
{
    return View::make('login');
});

Route::get('/auth/{provider}', array(
  'uses'  =>  'AuthenticationController@auth'
));

Route::get('/auth/{provider}/callback', array(
  'uses'  =>  'AuthenticationController@callback'
));


/*
|---------------------------------------------------------------------
|   handle url shortcuts, especially those carried forward from previous version
|---------------------------------------------------------------------
|   examples:
|   lebaneseblogs.com/beirutspring -> lebaneseblogs.com/blogger/beirutspring
|   lebaneseblogs.com/fashion -> lebanesbelogs.com/channel/fashion
*/

Route::get('{slug}', ['uses'  =>  'UrlController@redirect']);
