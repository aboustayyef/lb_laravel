<?php 

class ShowAuthors extends BaseController{

  function display($nameId){
    if ((Blog::find($nameId))||(Columnist::find($nameId))) {
      $posts = Post::Where('blog_id', $nameId)->take(30)->get();
      return View::make('authors.main')->with('posts', $posts);
    } else {
      return Response::make('Blogger Not Found', 404);
    }
  }
}