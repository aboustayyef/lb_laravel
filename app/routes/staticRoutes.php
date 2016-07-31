<?php 

/*
|--------------------------------------------------------------------------
| Static routes for the "about pages"
|--------------------------------------------------------------------------
| These are the routes to take us to static pages
 */

Route::get('/about/{slug?}', array(
    'as'    =>  'staticpages',
    'uses'  =>  'StaticPagesController@index'
));

Route::post('/about/{slug?}', array(
    'before'  =>  'csrf',
    'as'  =>  'submition',
    'uses'  =>  'StaticPagesController@submit'
));

?>