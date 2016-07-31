<?php 

Route::get('/ajax/GetMorePosts', array(
    'uses'  =>  'AjaxController@loadMorePosts'
));

Route::get('/ajax/GetTop5', array(
    'uses'  =>  'AjaxController@loadTopFivePosts'
));

// Note: Mobile version also has ajax routes. They're in the mobileRoutes file

?>