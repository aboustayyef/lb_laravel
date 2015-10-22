<?php

class YoustinkController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /youstink
	 *
	 * @return Response
	 */
	public function index($howmany=5)
	{
		$posts = Post::with('blog')->where('post_content', 'like', '%youstink%')
    ->orWhere('post_content', 'like', '%you stink%')
    ->orWhere('post_content', 'like', '%طلعت ريحتكم%')
    ->orderBy('post_timestamp','desc')->take($howmany)->get();

    return View::make('youstink')->with(compact('posts'));
	}

  public function index2($howmany=5)
  {
    $posts = Post::with('blog')
    ->where('post_content', 'like', '%youstink%')
    ->orWhere('post_content', 'like', '%you stink%')
    ->orWhere('post_content', 'like', '%طلعت ريحتكم%')
    ->where('post_title', 'like', '%youstink%')
    ->orWhere('post_title', 'like', '%you stink%')
    ->orWhere('post_title', 'like', '%طلعت ريحتكم%')
    ->orderBy('post_timestamp','desc')->take($howmany)->get();

    return $posts;
  }

}