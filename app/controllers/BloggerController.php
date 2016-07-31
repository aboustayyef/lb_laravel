<?php

class BloggerController extends BaseController{

  function showPosts($nameId){
    // if blog exists
    if (Blog::find($nameId)):
      Session::set('pageKind', 'blogger');
      Session::set('blogger', $nameId);

      // initialize posts counters
      Session::put('postsCounter', 0);
      Session::put('cardsCounter', 0);

      // initialize metadata and initial posts
      $initialPosts = Page::getPosts();
      $pageTitle = Page::getTitle();
      $pageDescription = Page::getDescription();
      $blog = Blog::find($nameId);

      return View::make('posts.main')->with([
        'blog'              => $blog,
        'initialPosts'      => $initialPosts,
        'pageTitle'         => $pageTitle,
        'pageDescription'   => $pageDescription
      ]);
      
    else :
      return Response::make('Blogger Not Found', 404);
    endif;
  }

}
