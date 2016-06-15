<?php

class PostsController2 extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /posts2
	 *
	 * @return Response
	 */
	
	public function index($channel='all', $action=null)
	{

		// 1- $channel is a child resolve it to its parent channel;
		$canonicalChannel = Channel::resolveTag($channel);

		// 2- if we have a subchannel, redirect to main channel
		if ($canonicalChannel != $channel) {
		  return Redirect::to('posts2/'.$canonicalChannel);
		}
		
		return View::make('posts2.main')->with(compact('channel'));

	}


}