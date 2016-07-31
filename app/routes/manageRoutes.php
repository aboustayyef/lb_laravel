<?php 

// Managing blogs and posts
// Controllers used: ManagementController and UploadImagesController

Route::group(array('prefix' => 'manage'), function()
{
    // Index page of management. 
    Route::get('{blogId?}/', [
        'uses'      =>  'ManagementController@index'
    ]);

    // Getting Satistics of Blog
    Route::get('{blogId}/getstats', [
        'uses'      =>  'ManagementController@getStats'
    ]);

    // Layouts for editing blog details or post details
    Route::get('{blogId}/edit/{blogOrPost?}/{postId?}', [
        'uses'      =>  'ManagementController@edit'
    ]);

    // Posting new blog/post/data
    Route::post('{blogId}/edit/{blogOrPost?}/{postId?}', [
        'before'    =>  'csrf',
        'uses'      =>  'ManagementController@update'
    ]);

    // Deleting Posts 
    Route::delete('{blogId}/edit/{blogOrPost?}/{postId?}', [
        'before'    =>  'csrf',
        'uses'      =>  'ManagementController@destroy'
    ]);


    // Posting new Avatar for blogs
    Route::post('uploadBlogAvatar/{blogId}', [
        'before'    =>  'csrf',
        'uses'      =>  'UploadImagesController@blogAvatar'
    ]);

    // Posting new Image for posts
    Route::post('uploadPostImage/{PostId}', [
        'before'    =>  'csrf',
        'uses'      =>  'UploadImagesController@postImage'
    ]);
});



?>