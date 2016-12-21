<?php 

// Redirect posts/ to posts/all
Route::get('/posts/', function(){
	return Redirect::to('/posts/all');
});

Route::get('/posts/all', array(
    'as'  =>  'allPosts',
    'uses'  =>  'AllPostsController@index'
));

Route::get('/posts/search/', array(
    'as'  =>  'searchPosts',
    'uses'  =>  'SearchPostsController@index'
));


Route::get('/posts/{channel}', array(
    'as'  =>  'channelPosts',
    'uses'  =>  'ChannelPostsController@index'
));

Route::get('/blogger/{nameId?}', array(
    'as'    =>  'bloggerPosts',
    'uses'  =>  'BloggerController@showPosts'
));

?>