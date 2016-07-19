<?php 

Route::get('/ajax/GetMorePosts', array(
    'uses'  =>  'AjaxController@loadMorePosts'
));

Route::get('/ajax/GetTop5', array(
    'uses'  =>  'AjaxController@loadTopFivePosts'
));

?>