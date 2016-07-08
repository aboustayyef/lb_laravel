<?php

class UserController extends \BaseController {

  public function index($section='following', $action=null)
  {

/**
 * See posts by blogs I'm following
 */

    if ($section == 'following'):

      Session::put('pageKind', 'following');
      // initialize posts counters
      Session::put('postsCounter', 0);
      Session::put('cardsCounter', 0);

/**
 * See posts I have liked
 */

    elseif ($section == 'liked'):
      Session::put('pageKind', 'liked');
      // initialize posts counters
      Session::put('postsCounter', 0);
      Session::put('cardsCounter', 0);

/**
 * Welcoming new user to new page
 */

    elseif ($section == 'welcome'):
      return View::make('static.welcome');

/**
 * Ajax actions to follow and unfollow, like and unlike blogs
 */
    elseif ($section == 'follow'):
      FollowController::add($action);
    elseif ($section == 'unfollow'):
      FollowController::remove($action);
    elseif ($section == 'like'):
      LikeController::add($action);
    elseif ($section == 'unlike'):
      LikeController::remove($action);
    endif;

    
    if (($section == 'following') || ($section == 'liked')) {
      // initialize metadata and initial posts
      $initialPosts = Page::getPosts();
      $pageTitle = Page::getTitle();
      $pageDescription = Page::getDescription();
      
      return View::make('posts.main')->with([
        'initialPosts'      => $initialPosts,
        'pageTitle'         => $pageTitle,
        'pageDescription'   => $pageDescription
      ]);
    }
  }
}
