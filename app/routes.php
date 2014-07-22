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

Route::get('/', function(){
  return Redirect::to('posts/all');
});

Route::get('posts', function(){
  return Redirect::to('posts/all');
});

Route::get('posts/{channel?}', array(
  'as'=>'posts', 
  'uses'=>'ShowPosts@display'
));

Route::get('ajaxGetMorePosts', array(
  'uses'  =>  'AjaxController@loadMorePosts'
));

Route::get('ajaxGetTop5', array(
  'uses'  =>  'AjaxController@loadTopFivePostsJson'
));

Route::get('login', array(
  'as'    =>  'login',
  'uses'  =>  'LoginController@initial'
));

Route::get('login/facebook', array(
  'uses'  =>  'LoginController@facebook'
));
Route::get('login/facebook/redirect', array(
  'uses'  =>  'LoginController@facebookRedirect'
));

Route::get('/blogger/{nameId?}', array(
  'as'    =>  'blogger',
  'uses'  =>  'ShowAuthors@display'
)); 

/*
|----------------- 
| Redirector
|-----------------
|
| Redirect outgoing links
|
|*/ 

Route::get('r', array(
  'uses'  => 'ExitController@lbExit'
));

/*
|--------------------------------------------------------------------------
| Testing Routes
|--------------------------------------------------------------------------
|
| The posts here are for testing purposes only and are not used by the app
|
*/

Route::get('test3', function(){
  $post = Post::where('post_url','http://hummusforthought.com/2014/03/29/the-problem-of-primitive-pride/')->first();
  echo $post->post_url;
  echo '<pre>',print_r($post),'</pre>';
  //echo $post->post_visits;
});


Route::get('test2', function(){
  $log = new ExitLog;
  if ($log->has('37.58.100.226', 'http://hummusforthought.com/2014/03/29/the-problem-of-primitive-pride/')) {
    echo 'record exists';
  } else {
    echo 'record doesnt exist';
  }
});

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
