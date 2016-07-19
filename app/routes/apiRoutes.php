<?php 

// Get a list of #youstink related posts
// An api hack for youstink.news

Route::get('/youstink2/{howmany?}', array(
    'as'  =>  'youstink',
    'uses'  =>  'youstinkController@index'
));

// Get a list of all the sources.
// Useful for importing to another database. Used for LBEngine

Route::get('/sources/{password}', function($password){
    if (Hash::check($password, '$2y$10$6PHNiZP68bq2KPF9QGzVN.2VrWbWYNEowZPgcIaKpisMVfmYjlxbm')) {
        return Blog::all();
    }
});


?>