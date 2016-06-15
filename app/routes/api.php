<?php 

Route::get('/api/posts/{channel}/{from}/{howmany}', function($channel,$from,$howmany){
	
	// To do: Guard against wrong data
	
	$posts = Post::getPosts($channel, $from, $howmany);

	$response = new stdClass;

	if (count($posts) > 1) {
		$response->status = 'ok';
		$response->posts = $posts;
		return Response::json($response);
	}
		$response->status = 'no posts';
		return Response::json($response);
});

?>