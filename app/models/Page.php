<?php


/**
 * This model is used to get Website content (title, description, initial content..)
 */

  class Page
  {
    public static  function getTitle(){

      $pagekind = Session::get('pageKind');

      if ((empty($pagekind)) || ($pagekind == 'allPosts')) {
        return 'Lebanese Blogs | Latest Posts from the Best Blogs and Vlogs';
      }

      if ($pagekind == 'channel') {
        $channelDescription = Channel::description(Session::get('channel'));
        return "Top $channelDescription blogs and vlogs in Lebanon | Lebanese Blogs";
      }

      if ($pagekind == 'blogger') {
        $bloggerDetails = Blog::find(Session::get('blogger'));
        $blogName = $bloggerDetails->blog_name;
        return $blogName.' At Lebanese Blogs';
      }

      if ($pagekind == 'searchResults'){
          return 'Search Results for ' . Session::get('searchQuery');
      }

    }

    public static  function getDescription(){

      $pagekind = Session::get('pageKind');

      if ((empty($pagekind)) || ($pagekind == 'allPosts')) {
        return 'The best place to discover Lebanon\'s top blogs and vlogs';
      }

      if ($pagekind == 'channel') {
        $channelDescription = Channel::description(Session::get('channel'));
        return "Top $channelDescription posts in Lebanon";
      }


      if ($pagekind == 'blogger') {
        $bloggerDetails = Blog::find(Session::get('blogger'));
        $blogName = $bloggerDetails->blog_name;
        return 'Latest posts by ' . $blogName . ' At Lebanese Blogs';
      }

      if ($pagekind == 'searchResults'){
          return 'Search Results for ' . Session::get('searchQuery');
      }
    }

    public static function topPostsDescription(){
      $pagekind = Session::get('pageKind');

      if ((empty($pagekind)) || ($pagekind == 'allPosts')) {
        return 'These are recent posts that our users have found most interesting and shareworthy';
      }

      if ($pagekind == 'channel') {
        $channelDescription = Channel::description(Session::get('channel'));
        return "These are recent $channelDescription posts that our users have found most interesting and shareworthy";
      }

      if ($pagekind == 'blogger') {
        $bloggerDetails = Blog::find(Session::get('blogger'));
        $blogName = $bloggerDetails->blog_name;
        return 'Recent popular posts by '. $blogName;
      }
    }

    public static function getPosts($from=0, $amount=20){

      $pagekind = Session::get('pageKind');

      if ( $pagekind == 'allPosts'):
        $posts = Post::getPosts('all', $from, $amount);
        return $posts;

      elseif ( $pagekind == 'blogger'):
        $bloggerId = Session::get('blogger');
        $posts = Post::getPostsByBlogger($bloggerId, $from, $amount);
        return $posts;

      elseif ( $pagekind == 'channel'):
        $channel = Session::get('channel');
        $posts = Post::getPosts($channel, $from, $amount);
        return $posts;

      elseif ( $pagekind == 'searchResults'):
        $posts = lbFunctions::postsSearch( Session::get('searchQuery') , $amount);
        if (!$posts) {
          return Session::get('searchMeta')['errorMessage'];
        }
        return $posts;
      endif;
    }
  }
