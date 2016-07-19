<?php

class ManagementController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /management
	 *
	 * @return Response
	 */
	
	public function index($blogId = null)
	{
		// Authorization filtering
		$response = $this->filter($blogId);
		if ( $response != 'ok') {
			return $response;
		}

		$blog = Blog::where('blog_id',$blogId)->first();
		return View::Make('manage.index')->with(compact('blog'));
	}

	/**
	 *	Editing of posts and blog details
	 */
	

	public function edit($blogId, $blogOrPost, $postId = null )
	{

		// FILTERING to make sure of authorization and correct urls
		//===========================================================
		//
		// Authorization filtering
		$response = $this->filter($blogId);
		if ( $response != 'ok') {
			return $response;
		}
		//
		// url correctness filtering (Make sure $blogOrPost is either "blog" or "post")
		if (!in_array($blogOrPost, ['blog','post'])) {
			return Response::make('Bad URL', 404);
		}
		//
		// if 'blog', make sure $postId is empty
		if ($blogOrPost == 'blog' && $postId != null) {
			return Redirect::to("/manage/$blogId/edit/blog");
		}
		//
		// if 'post', make sure $postId is valid
		if ($blogOrPost == 'post') {

			// handle the case where the post id is null
			if ($postId == null) {
				return Response::make('You need to specify a Post Id', 404);
			}

			// handle the case where a post doesn't exist
			$postExists = Post::where('post_id', $postId)->get()->count() > 0;
			if (!$postExists) {
				return Response::make('This Post does not exist', 404);
			}

			// handle the case where the post doesnt belong to the blog
			$postBlog = Post::where('post_id', $postId)->get()->first()->blog_id;
			if ($postBlog != $blogId) {
				return Response::make('This Post does not belong to this blog', 401);
			}

		}		
		//===========================================================

		return View::make('manage.' . $blogOrPost . 'Edit')->with(compact('blogId'))->with(compact('postId'));

	}

	public function update($blogId, $blogOrPost, $postId = null){
		if ($blogOrPost == 'blog') {
			$blog = Blog::where('blog_id',$blogId)->get()->first();
			$newBlogInfo = Input::all();
			array_shift($newBlogInfo); // removes _token
			$blog->fill($newBlogInfo);
			$blog->save();
			return Redirect::to('/manage/' . $blogId)->with('lbSuccessMessage', 'Changes to Blog details succesful');
		}
	}

	private function filter($blogId = null){
		
		// if nobody is signed in, return unauthorized 401

		if ( ! Session::has('SignedInUser')) {

			return Response::make('Unauthorized. You have to be signed in with a valid blogger twitter account', 401);

		// else if someone is signed in

		} else { 

			$blogger = new Blogger(Session::get('SignedInUser')['twitterHandle']);

			// if the specified blog in the route doesn't exist, redirect to signed in User's default blog

			if (! Blog::exists($blogId)) {
				return Redirect::To('/manage/'. $blogger->defaultBlog());
			}

			// if the specified blog in the route exists, make sure the person is authorized to access it

			if (! $blogger->canManage($blogId)) {
				return Response::make('This account does not have access to this blog', 401);
			}
			
		}

		return 'ok';
	}

}