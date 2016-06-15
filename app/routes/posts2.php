<?php 

Route::get('/posts2/{channel}/{action?}', [
    'uses'  =>  'PostsController2@index',
]);

?>