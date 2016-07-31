<?php 

Route::get('/posts/{channel}/{action?}', array(
    'as'  =>  'posts',
    'uses'  =>  'PostsController@index'
));

Route::get('/blogger/{nameId?}', array(
    'as'    =>  'blogger',
    'uses'  =>  'BloggerController@showPosts'
));

Route::get('posts/search', array(
    'as'      =>  'search',
    'uses'    =>  'PostsController@search'
));

?>