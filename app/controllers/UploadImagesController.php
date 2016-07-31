<?php

class UploadImagesController extends \BaseController {

	public function blogAvatar($blogId)
	{
		try 
		{
			if (Input::hasFile('file'))
			{
				Image::make(Input::file('file'))->fit(100,100)->save(public_path().'/img/thumbs/'.$blogId.'.jpg'); 
			}
		} 
		catch (Exception $e)
		{
		  return false;
		}
	}

	public function postImage($postId)
	{
		$post = Post::findOrFail($postId);
		$post->post_image_height = 165;
		$post->post_image_width = 300;
		$post->save();
		$post = Post::findOrFail($postId); // refresh metadata
		Image::make(Input::file('file'))->fit(300,165)->save(public_path().'/img/cache/'.$post->post_timestamp.'-' . $post->post_id . '.jpg');
	}
}