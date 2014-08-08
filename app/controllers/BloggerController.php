<?php

class BloggerController extends BaseController{

  function showPosts($nameId){
    if ((Blog::find($nameId))||(Columnist::find($nameId))) {
      $posts = Post::getPostsByBlogger($nameId, 0, 20);

      // Sessions are used for when ajax wants to load more posts
      Session::put('pageKind', 'blogger');
      Session::put('blogger', $nameId);

      return View::make('authors.main')->with('posts', $posts);
    } else {
      return Response::make('Blogger Not Found', 404);
    }
  }
}
