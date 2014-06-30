<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{

    $data = array();
 
    if (Auth::check()) {
        $data = Auth::user();
    }
    return View::make('user', array('data'=>$data));

});
 
Route::get('logout', function() {

    Auth::logout();
    return Redirect::to('/');

});

/*********************

    FACEBOOK login

**********************/

Route::get('login/fb', function() {

    // appId and appSecret are stored in config/facebook.php
    $facebook = new Facebook(Config::get('facebook'));

    $params = array(
        'redirect_uri' => url('/login/fb/callback'),
        'scope' => 'email',
    );
    return Redirect::to($facebook->getLoginUrl($params));
});

Route::get('login/fb/callback', function() {
    $code = Input::get('code');
    if (strlen($code) == 0) return Redirect::to('/')->with('message', 'There was an error connecting to Facebook');
 
    $facebook = new Facebook(Config::get('facebook'));
    $uid = $facebook->getUser();
 
    if ($uid == 0) return Redirect::to('/')->with('message', 'There was an error');
 
    $me = $facebook->api('/me');
 	

    // check if user has been registered already
    $user = User::whereUserid($me['email'])->first();

    if ( !$user ) {
        
        // if not, get params and register
        $user = new User; 
        $user->name = $me['first_name'].' '.$me['last_name'];
        $user->userid = $me['email'];

        $user->save();
    } 
  
    Auth::login($user);
    return Redirect::to('/')->with('message', 'Logged in with Facebook');
});

/*********************

    TWITTER login

**********************/

Route::get('login/twitter', function() {
    // Reqest tokens
    $tokens = Twitter::oAuthRequestToken();

    // Redirect to twitter and come to /twitter-auth
    Twitter::oAuthAuthenticate(array_get($tokens, 'oauth_token'));
    exit;
});

Route::get('/twitter-auth', function(){
    // Oauth token
    $token = Input::get('oauth_token');

    // Verifier token
    $verifier = Input::get('oauth_verifier');

    // Request access token
    $accessToken = Twitter::oAuthAccessToken($token, $verifier);

    // check if user has been registered already by userId
    $user = User::whereUserid($accessToken['user_id'])->first();

    if ( !$user ) {
        
        // if not, get params and register
        $user = new User; 
        $user->name = $accessToken['screen_name'];
        $user->userid = $accessToken['user_id'];

        $user->save();
    } 
  
    Auth::login($user);
    return Redirect::to('/')->with('message', 'Logged in with Twitter');
});