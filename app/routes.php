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
  return Redirect::to('posts/all');

});

Route::get('/youstink/{howmany?}', array(

  'as'  =>  'youstink',
  'uses'  =>  'youstinkController@index'

));

Route::group(array('prefix' => 'admin', 'before' => 'admin.auth'), function()
{
    Route::get('addBlog',array(
      'as'  =>  'admin.getAddBlog',
      'uses' => 'adminController@getstep1'
    ));

    Route::get('addBlog/step2',array(
      'as'  =>  'admin.getstep2',
      'uses' => 'adminController@getstep2'
    ));

    Route::post('addBlog/step2',array(
      'as'  =>  'admin.storeBlog',
      'uses' => 'adminController@store'
    ));

});


Route::get('/mobileAjax/b/{blogger}/{from}/{howmany}', array(
  'uses'  =>  'MobileAjaxController@bloggerIndex'
));

Route::get('/mobileAjax/{channel}/{from}/{howmany}', array(
  'uses'  =>  'MobileAjaxController@index'
));

Route::get('/news', array(
  'uses'  =>  'NewsController@index'
));

Route::get('/user/{section}/{action?}', array(
  'before'  =>  'lb.auth:following',
  'as'  =>  'user',
  'uses'  =>  'UserController@index'
));

Route::get('mobile/{set}/{detail?}', array(
  'as'  =>  'mobile',
  'uses'  =>  'MobileController@index'
));

Route::get('/posts/{channel}/{action?}', array(
  'as'  =>  'posts',
  'uses'  =>  'PostsController@index'
));

// redirect outgoing links, for exit link counting and registering
Route::get('exit', array(
  'uses'  => 'ExitController@lbExit'
));

Route::get('posts/search', array(
  'as'      =>  'search',
  'uses'    =>  'PostsController@search'
));

Route::get('/blogger/{nameId?}', array(
  'as'    =>  'blogger',
  'uses'  =>  'BloggerController@showPosts'
));

Route::get('/edit/{what?}/{which?}', array(
  'uses'  =>  'EditController@index'
));

Route::post('/edit/{what?}/{which?}', array(
  'before'  =>  'csrf',
  'uses'  =>  'EditController@submit'
));

Route::get('/delete/{what?}/{which?}', array(
  'uses'  =>  'DeleteController@index'
));

Route::get('/ajax/GetMorePosts', array(
  'uses'  =>  'AjaxController@loadMorePosts'
));

Route::get('/ajax/GetTop5', array(
  'uses'  =>  'AjaxController@loadTopFivePosts'
));

/*
|---------------------------------------------------------------------
|   Logging out
|---------------------------------------------------------------------
|
|   destroys cookies and sessions
|
*/

Route::get('/logout',function()
{
  Session::forget('lb_user_id');
  $cookie = Cookie::forget('lb_user_id');
  return Redirect::to('/')->withCookie($cookie);
});


/*
|--------------------------------------------------------------------------
| Static routes for the "about pages"
|--------------------------------------------------------------------------
| These are the routes to take us to static pages
*/

Route::get('/about/{slug?}', array(
  'as'    =>  'staticpages',
  'uses'  =>  'StaticPagesController@index'
));

Route::post('/about/{slug?}', array(
  'before'  =>  'csrf',
  'as'  =>  'submition',
  'uses'  =>  'StaticPagesController@submit'
));


/*
|---------------------------------------------------------------------
|   The Login Page
|---------------------------------------------------------------------
|
*/

Route::get('/login',function()
{
    if (Input::has('follow')) {
      Session::set('blogToFollow', Input::get('follow'));
     }
    if (Input::has('like')) {
      Session::set('postToLike', Input::get('like'));
     }
    if (Input::has('camefrom')){
      Session::set('finalDestination', Input::get('camefrom'));
    }
    return View::make('login');
});

/**
 * Blog Routes. This will redirect old blog urls based on subfolder to new subdomain.
 */

Route::get('/blog/{slug1?}/{slug2?}/{slug3?}/{slug4?}', function($slug1=null, $slug2=null, $slug3=null, $slug4=null){
  $endSlug = '/'. $slug1 .'/'. $slug2 .'/'. $slug3 .'/'. $slug4;
  return Redirect::to('http://blog.lebaneseblogs.com'.$endSlug);
});


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
|---------------------------------------------------------------------
|   handle url shortcuts, especially those carried forward from previous version
|---------------------------------------------------------------------
|   examples:
|   lebaneseblogs.com/beirutspring -> lebaneseblogs.com/blogger/beirutspring
|   lebaneseblogs.com/fashion -> lebanesbelogs.com/channel/fashion
*/
Route::get('{slug}', ['uses'  =>  'UrlController@redirect']);
