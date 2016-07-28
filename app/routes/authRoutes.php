<?php 
/*
|---------------------------------------------------------------------
|   Auth routes
|---------------------------------------------------------------------
|
 */

Route::get('/login',function()
{
    return View::make('login');
});

Route::get('/signout',function()
{
    Session::forget('SignedInBlogger');
    return Redirect::to('/posts/all');
});

Route::get('/auth/twitter', array(
    'uses'  =>  'AuthenticationController@auth'
));

Route::get('/auth/twitter/callback', array(
    'uses'  =>  'AuthenticationController@callback'
));

?>