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
      $bloggerDetails = Blog::find($nameId);
      $blogName = $bloggerDetails->blog_name;

      $pageTitle = $blogName . " at Lebanese Blogs" ;
      $pageDescription = 'Latest posts by ' . $blogName . ' At Lebanese Blogs';
      $initialPosts = Post::getPostsByBlogger($nameId, 0, 20);

      return View::make('posts.main')->with([
        'blog'              => $bloggerDetails,
        'initialPosts'      => $initialPosts,
        'pageTitle'         => $pageTitle,
        'pageDescription'   => $pageDescription
      ]);
      
    else :
      return Response::make('Blogger Not Found', 404);
    endif;
  }

}
