<?php

class UploadImagesController extends \BaseController {

	public function blogAvatar($blogId)
	{
		try 
		{
			if (Input::hasFile('file'))
			{
				// file name: timestamp-blogId.jpg
				$fileName = time() . '-' . $blogId;
				Image::make(Input::file('file'))->fit(100,100)->save(public_path().'/img/thumbs/' . $fileName . '.jpg');
				$b = Blog::find($blogId);
				$b->blog_thumb = $fileName;
				$b->save();
				return 'success';
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
		$postname = $post->post_timestamp . '-' . $post->post_id;
		try {
			Image::make(Input::file('file'))->fit(300,165)->save(public_path().'/img/cache/'. $postname . '.jpg');
		} catch (Exception $e) {
			$user = shell_exec('whoami');
			return "Could Not upload image to " . public_path().'/img/cache/'. $postname . '.jpg' ; 			
		}
		$post->post_local_image = $postname ;
		$post->save();
	}
}