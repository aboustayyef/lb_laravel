<?php 

Route::group(array('prefix' => 'admin', 'before' => 'admin.auth'), function()
    {
        Route::get('addBlog',array(
            'as'  =>  'admin.getAddBlog',
            'uses' => 'adminController@getstep1'
        ));

        Route::get('addBlog/step2',array(
            'as'  =>  'admin.getstep2',
            'uses' => 'adminController@getstep2'
        ));

        Route::post('addBlog/step2',array(
            'as'  =>  'admin.storeBlog',
            'uses' => 'adminController@store'
        ));

    });

?>