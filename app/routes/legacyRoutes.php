<?php 

// The default route. Check url 'channel' parameter for backward compatibility 
// Default entrypoint is /posts/all

/*
 	/?channel=fashion -----> /posts/fashion 
*/
Route::get('/', function(){
    if (Input::has('channel')) {
        return Redirect::to('/posts/'.Input::get('channel'));
    }
    return Redirect::to('posts/all');
});


/**
 * Blog Routes. Redirects from [/blog/slug] to [blog.lebaneseblogs.com/slug] This became necessary when moved to laravel and could no longer use /blog for wordpress. 

	lebaneseblogs.com/blog/00/title_of_post ----> blog.lebaneseblogs.com/00/title_of_post

 */

Route::get('/blog/{slug1?}/{slug2?}/{slug3?}/{slug4?}', function($slug1=null, $slug2=null, $slug3=null, $slug4=null){
    $endSlug = '/'. $slug1 .'/'. $slug2 .'/'. $slug3 .'/'. $slug4;
    return Redirect::to('http://blog.lebaneseblogs.com'.$endSlug);
});

?>