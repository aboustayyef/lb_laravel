<?php

/**
 * This controller handles the management of a blogger's blogs and posts
 * Blogger Logs in using twitter and then "manages" their blog.
 */

class ManagementController extends \BaseController {


	// Display lists of posts by chosen blog

	public function index($blogId = null)
	{
		// Authorization filtering
		$response = $this->filter($blogId);
		if ( $response != 'ok') {
			return $response;
		}

		$blog = Blog::where('blog_id',$blogId)->first();
		$allBlogsByAuthor = Blog::where('blog_author_twitter_username', $blog->blog_author_twitter_username)->get();
		$posts = $blog->posts()->orderBy('post_timestamp', 'desc')->take(10)->get();
		$stats = $blog->stats();

		return View::Make('manage.index')
			->with( compact('blog'))
            ->with( compact('allBlogsByAuthor'))
   		    ->with( compact('posts'))
		    ->with( compact('stats'));
	}

	
	//	Edit details of posts or blog 
	
	public function edit($blogId, $blogOrPost=null, $postId = null )
	{

		// Authorization filtering
		$response = $this->filter($blogId);
		if ( $response != 'ok') {
			return $response;
		}

		// Syntax and proper data filtering
		$response = $this->filter2($blogId, $blogOrPost, $postId);
		if ( $response != 'ok') {
			return $response;
		}

		$blog = Blog::where('blog_id', $blogId)->get()->first();
		if ($postId) {
			$post = Post::findOrFail($postId);
		}

		return View::make('manage.' . $blogOrPost . 'Edit')->with(compact('blog'))->with(compact('post'));

	}

	// update and store the changes made on the form

	public function update($blogId, $blogOrPost, $postId = null){
		if ($blogOrPost == 'blog')
		{

			$validation = Blog::validate(Input::all());

			if ($validation != 'ok') {
			  return Redirect::back()->withErrors($validation)->withInput();
			}

			if (Blog::store($blogId, Input::except('_token'))) {
				lb_log('Edits made to ' . $blogId , 'Management.log');
				return Redirect::to('/manage/' . $blogId)->with('lbSuccessMessage', 'Changes to Blog details succesful');
			}

			die('something went wrong');
			
		}
		if ($blogOrPost == 'post') 
		{
			$validation = Post::validate(Input::all());

			if ($validation != 'ok') {
			  return Redirect::back()->withErrors($validation)->withInput();
			}

			if (Post::store($postId, Input::except('_token'))) {
				return Redirect::to('/manage/' . $blogId)->with('lbSuccessMessage', 'Changes to post succesful');
			}
		}
	}

	public function destroy($blogId, $blogOrPost, $postId = null){
		$post = Post::findOrFail($postId);
		$post->delete();
		return Redirect::to('/manage/' . $blogId)->with('lbSuccessMessage', 'Post Deleted Succesfully');
	}


	public function getStats($blogId = null)
	{
		// Authorization filtering
		$response = $this->filter($blogId);
		if ( $response != 'ok') {
			return $response;
		}

		$blog = Blog::where('blog_id',$blogId)->first();
		return $blog->stats();
	}


	// filter to make sure authorization is correct and only signed in bloggers have access to their blogs

	private function filter($blogId = null){
		
		// if nobody is signed in, return unauthorized 401

		if ( ! Session::has('SignedInBlogger')) {

			return Response::make('Unauthorized. You have to be signed in with a valid blogger twitter account', 401);

		// else if someone is signed in

		} else { 

			$blogger = Session::get('SignedInBlogger');

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

	// filter to make sure urls are well formed and posts belong to their blogs

	private function filter2($blogId, $blogOrPost, $postId){

		// url correctness filtering (Make sure $blogOrPost is either "blog" or "post")
		if (!in_array($blogOrPost, ['blog','post'])) {
			return App::abort(404);
		}

		// if 'blog', make sure $postId is empty
		if ($blogOrPost == 'blog' && $postId != null) {
			return Redirect::to("/manage/$blogId/edit/blog");
		}

		// if 'post', make sure $postId is valid
		if ($blogOrPost == 'post') {

			// handle the case where the post id is null
			if ($postId == null) {
				return Response::make('You need to specify a Post Id', 400);
			}

			// handle the case where a post doesn't exist
			if (!Post::exists($postId)) {
				return Response::make('This Post does not exist', 400);
			}

			// handle the case where the post doesnt belong to the blog
			$postBlog = Post::where('post_id', $postId)->get()->first()->blog_id;
			if ($postBlog != $blogId) {
				return Response::make('This Post does not belong to this blog', 400);
			}
		}	

		// if everything passes
 
		return 'ok';
	}

}