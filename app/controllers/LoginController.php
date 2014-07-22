<?php 	
/**
* 
*/
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;

/*******************************************************************
*	The class below is a solution to an issue where laravel doesn't
* 	accept Facebook's vanila php handling of Sessions
* 	Source: https://github.com/facebook/facebook-php-sdk-v4/issues/39
********************************************************************/ 
class MyFacebookRedirectLoginHelper extends \Facebook\FacebookRedirectLoginHelper
{
  protected function storeState($state)
  {
    Session::put('state', $state);
  }

  protected function loadState()
  {
    return $this->state = Session::get('state');
  }
}

class LoginController extends BaseController
{
	
	function initial(){
		return View::make('signin.initial');
	}

	function facebook(){
		FacebookSession::setDefaultApplication($_ENV['FACEBOOK_APP_ID'],$_ENV['FACEBOOK_APP_SECRET']);
		$helper = new MyFacebookRedirectLoginHelper($_ENV['FACEBOOK_REDIRECT_URL']);
		$loginUrl = $helper->getLoginUrl();
		return Redirect::away($loginUrl);
	}

	function facebookRedirect(){
		FacebookSession::setDefaultApplication($_ENV['FACEBOOK_APP_ID'],$_ENV['FACEBOOK_APP_SECRET']);
		$helper = new MyFacebookRedirectLoginHelper($_ENV['FACEBOOK_REDIRECT_URL']);;
		try {
		  $session = $helper->getSessionFromRedirect();
		} catch(FacebookRequestException $ex) {
		  echo 'Facebook returned an error';
		} catch(\Exception $ex) {
		  echo 'Validation Failed';
		}
		if($session) {

		  try {

		    $user_profile = (new FacebookRequest($session, 'GET', '/me'))
		    ->execute()
		    ->getGraphObject(GraphUser::className());

		    echo '<pre>',var_dump($user_profile),'</pre>';
		    echo '<pre>',var_dump($session),'</pre>';
		    echo '<b>',$session->getToken(),'</b>';

		  } catch(FacebookRequestException $e) {

		    echo "Exception occured, code: " . $e->getCode();
		    echo " with message: " . $e->getMessage();

		  }   

		}
	}
}
?>