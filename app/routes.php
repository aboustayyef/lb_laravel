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

Route::get('manage/{blogId?}/', [
    'as'    =>  'manage',
    'uses'  =>  'ManagementController@index'
]);

Route::get('manage/{blogId}/edit/{blogOrPost?}/{postId?}', [
    'as'    =>  'manage',
    'uses'  =>  'ManagementController@edit'
]);

Route::post('manage/{blogId}/edit/{blogOrPost?}/{postId?}', [
    'as'    =>  'manage.update',
    'uses'  =>  'ManagementController@update'
]);

// legacy routes
require_once(app_path().'/routes/legacyRoutes.php');

// api routes. Send data to other apps.
require_once(app_path().'/routes/apiRoutes.php');

// authentication routes for bloggers to sign in with twitter
require_once(app_path().'/routes/authRoutes.php');

// administration routes for superuser (me!) for actions like adding blogs
require_once(app_path().'/routes/adminRoutes.php');


Route::get('/mobileAjax/b/{blogger}/{from}/{howmany}', array(
    'uses'  =>  'MobileAjaxController@bloggerIndex'
));

Route::get('/mobileAjax/{channel}/{from}/{howmany}', array(
    'uses'  =>  'MobileAjaxController@index'
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

require_once(app_path(). '/routes/ajaxRoutes.php');

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
|   handle url shortcuts, especially those carried forward from previous version
|---------------------------------------------------------------------
|   examples:
|   lebaneseblogs.com/beirutspring -> lebaneseblogs.com/blogger/beirutspring
|   lebaneseblogs.com/fashion -> lebanesbelogs.com/channel/fashion
 */
Route::get('{slug}', ['uses'  =>  'UrlController@redirect']);
