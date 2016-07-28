<?php

/*
|---------------------------------------------------------------------
|   Implementing signin with Facebook, Twitter and Google
|---------------------------------------------------------------------
|
|   This class handles both the authentication component
|   and the callback components of the signin
|
*/

class AuthenticationController extends BaseController
{

  function auth(){

    // Retrieve temporary credentials
    $temporaryCredentials = AuthenticationServer::twitter()->getTemporaryCredentials();

    // Store credentials in the session, we'll need them later
    Session::put('temporaryCredentials', $temporaryCredentials);
    Session::save();

    // Redirect the resource owner to the login screen on the server.
    $url = AuthenticationServer::twitter()->getAuthorizationUrl($temporaryCredentials);
    return Redirect::To($url);

  }

  function callback(){

    if ((Input::has('oauth_token')) && (Input::has('oauth_verifier'))) {
        // We will now retrieve token credentials from the server
        $tokenCredentials = AuthenticationServer::twitter()->getTokenCredentials(
          Session::get('temporaryCredentials'),
          Input::get('oauth_token'),
          Input::get('oauth_verifier')
        );

        // User is an instance of League\OAuth1\Client\Server\User
        $user = AuthenticationServer::twitter()->getUserDetails($tokenCredentials);

        // Twitter returns full name
        $names = explode(' ', $user->name);
        if (count($names) > 1) {
          $twitterLastName = $names[1];
        } else {
          $twitterLastName = '';
        }
        $userDetails = array(
          'twitterId' => $user->uid,
          'twitterHandle' =>  $user->nickname,
          'firstName'  => $names[0],
          'lastName'  =>  $twitterLastName,
          'email'     =>  $user->email,
          'imageUrl'  =>  $user->urls['profile_image_url']
        );

        // check if twitter ID is associated with a blog
        if (Blog::where('blog_author_twitter_username', $userDetails['twitterHandle'])->get()->count() > 0) {
          Session::put('SignedInUser', $userDetails);
          Session::put('SignedInBlogger', new Blogger($userDetails['twitterHandle']));
          return Redirect::to('/posts/all');
        } else {
          Session::flash('NoBlogFound',true);
          return Redirect::to('/posts/all');
        }
        
        
    } else {
      Session::flash('message', 'Sorry, Could not sign in. Want to try again?');
      return View::make('login');
    }
  }

}