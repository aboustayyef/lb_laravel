<?php
  /**
  *
  */
  class SearchPostsController extends BaseController
  {

    /*
    *   This function displays our initial rendering of posts
    */

    function index(){
        
        $query = stripcslashes(Input::get('q'));

        if (empty($query)) 
        {
          // if no parameters, forward back to home page
          return Redirect::to('/posts/all');
        }
        else
        {

          // Special Case: If the query is exactly a blog's name redirect to that blog's page
          if ($b = Blog::existsByName($query)) { return Redirect::to('/blogger/' . $b) ; }

          // initialize posts counters
          Session::put('postsCounter', 0);
          Session::put('cardsCounter', 0);
          Session::put('pageKind', 'searchResults');
          Session::put('searchQuery', $query);

          // Add search query to LB's Search log
          lb_log($query, 'SearchTerms.log');
          
          // initialize metadata 
          $pageTitle = 'Search Results for ' . Session::get('searchQuery');
          $pageDescription = 'Search Results for ' . Session::get('searchQuery');

          // prepare initial posts
          $initialPosts = lbFunctions::postsSearch( $query , 20);
          if (!$initialPosts) {
            $initialPosts = Session::get('searchMeta')['errorMessage'];
          }

          return View::make('posts.main')->with([
            'initialPosts'      => $initialPosts,
            'pageTitle'         => $pageTitle,
            'pageDescription'   => $pageDescription
          ]);
        }
      }
}
