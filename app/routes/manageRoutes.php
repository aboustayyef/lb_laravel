<?php 

// Managing blogs and posts

Route::group(array('prefix' => 'manage'), function()
{
    Route::get('{blogId?}/', [
        'as'        =>  'manage.blog',
        'uses'      =>  'ManagementController@index'
    ]);

    Route::get('{blogId}/edit/{blogOrPost?}/{postId?}', [
        'as'        =>  'manage.post',
        'uses'      =>  'ManagementController@edit'
    ]);
});

// Getting Satistics of Blog
Route::get('/manage/{blogId}/getstats', [
    'as'        =>  'getstats',
    'uses'      =>  'ManagementController@getStats'
]);


// Posting Data

// Posting new blog/post/data
Route::post('manage/{blogId}/edit/{blogOrPost?}/{postId?}', [
    'before'    =>  'csrf',
    'as'        =>  'manage.update',
    'uses'      =>  'ManagementController@update'
]);

// Posting new Avatar for blog
Route::post('/manage/uploadBlogAvatar/{blogId}', [
    'before'    =>  'csrf',
    'uses'      =>  'UploadImagesController@blogAvatar'
]);

// Posting new Image for post
Route::post('/manage/uploadPostImage/{PostId}', [
    'before'    =>  'csrf',
    'uses'      =>  'UploadImagesController@postImage'
]);

// Deleting 
Route::delete('/manage/{blogId}/edit/{blogOrPost?}/{postId?}', [
    'before'    =>  'csrf',
    'as'        =>  'posts.destroy',
    'uses'      =>  'ManagementController@destroy'
]);

?>