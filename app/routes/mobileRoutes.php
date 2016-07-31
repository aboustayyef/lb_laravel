<?php 

Route::get('/mobileAjax/b/{blogger}/{from}/{howmany}', array(
    'uses'  =>  'MobileAjaxController@bloggerIndex'
));

Route::get('/mobileAjax/{channel}/{from}/{howmany}', array(
    'uses'  =>  'MobileAjaxController@index'
));


Route::get('mobile/{set}/{detail?}', array(
    'as'  =>  'mobile',
    'uses'  =>  'MobileController@index'
));

?>