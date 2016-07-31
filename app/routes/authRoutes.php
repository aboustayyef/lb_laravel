<?php 
/*
|---------------------------------------------------------------------
|   Auth routes
|---------------------------------------------------------------------
|
 */

Route::get('/signout',function()
{
    Session::forget('SignedInBlogger');
    Session::forget('SignedInUser');
    return Redirect::to('/posts/all');
});

Route::get('/auth/twitter', array(
    'uses'  =>  'AuthenticationController@auth'
));

Route::get('/auth/twitter/callback', array(
    'uses'  =>  'AuthenticationController@callback'
));

?>