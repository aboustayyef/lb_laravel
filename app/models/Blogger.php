<?php

class Blogger {

	public $twitterId, $blogIds, $isAdmin;

	public function __construct($twitterId){
		$this->twitterId = strtolower($twitterId);
		$this->blogIds = Blog::where('blog_author_twitter_username', $this->twitterId)->get()->lists('blog_id');
		if ($this->twitterId == 'beirutspring') {
			$this->isAdmin = true;
		} else {
			$this->isAdmin = false;
		}
	}

	public function defaultBlog(){
		return $this->blogIds[0];
	}

	public function canManage($blog)
	{
		if ($this->isAdmin || in_array($blog, $this->blogIds)) {
		 	return true;
		}
		return false; 
	}



}