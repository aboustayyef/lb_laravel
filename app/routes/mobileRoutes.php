<?php 

Route::get('/mobileAjax/b/{blogger}/{from}/{howmany}', array(
    'uses'  =>  'MobileAjaxController@bloggerIndex'
));

Route::get('/mobileAjax/{channel}/{from}/{howmany}', array(
    'uses'  =>  'MobileAjaxController@index'
));

Route::group(['prefix'=>'mobile'], function(){
	Route::get('/posts/{channel}/{action?}', array(
	    'as'  =>  'mobile',
	    'uses'  =>  'PostsController@index'
	));	
});

?>