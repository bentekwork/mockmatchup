<?php

namespace Mock\UserBundle\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Mock\UserBundle\Entity\User;


class MockOauth {
	
	//Set contstructs
  public $key;
  public $secret;

  function __construct($key, $secret) {
    $this->key = $key;
    $this->secret = $secret;

  }

	//Get Request Token
  function getRequesttoken(){
	$o = new \OAuth( $this->key, $this->secret, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI );
	$o->enableDebug();
	
	try {
	  $response = $o->getRequestToken( "https://api.login.yahoo.com/oauth/v2/get_request_token", 'http://mock.dnsalias.com/user/setaccess' );
	  $this->request_token = $response['oauth_token'];
	  $this->request_token_secret = $response['oauth_token_secret'];
	  $this->xoauth_request_auth_url = $response['xoauth_request_auth_url'];
	  
	} catch( \OAuthException $e ) {
	 return false;
	}
  }
  
  function getAccesstoken($request_token, $request_token_secret = '', $verifier = ''){
	$o = new \OAuth( $this->key, $this->secret, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI );
	$o->setToken($request_token, $request_token_secret);
	$o->enableDebug();
	try {
      $response = $o->getAccessToken( 'https://api.login.yahoo.com/oauth/v2/get_token', null, $verifier );
	  //add in addding or updating the user
	  if(isset($response['oauth_token'])){
	  	$this->access_token = $response['oauth_token'];
	  } else {
		//wierd bug where the first key of $response is not recognized.
		reset($response);
		$this->access_token = $response[key($response)];
	  }
	  $this->access_token_secret = $response['oauth_token_secret'];
	  $this->oauth_expires_in = $response['oauth_expires_in'];
	  $this->oauth_session_handle = $response['oauth_session_handle'];
	  $this->xoauth_yahoo_guid = $response['xoauth_yahoo_guid'];
	  $this->verifier = $verifier;

	} catch( \OAuthException $e ) {
	  $error = 'Error: ' . $e->getMessage() . "\n";
	  $error .= 'Response: ' . $e->lastResponse . "\n";
	  return false;
	}
  }

  function refreshAccesstoken($access_token, $access_token_secret, $session_handle, $verifier){
	$o = new \OAuth( $this->key, $this->secret, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI );
	$o->setToken($access_token, $access_token_secret);
    
	$o->enableDebug();
	try {
      $response = $o->getAccessToken( 'https://api.login.yahoo.com/oauth/v2/get_token',  $session_handle, $verifier);
	  //add in updating the user object
	  $this->access_token = $response['oauth_token'];
	  $this->access_token_secret = $response['oauth_token_secret'];
	  $this->oauth_expires_in = $response['oauth_expires_in'];
	  $this->oauth_session_handle = $response['oauth_session_handle'];
	  $this->xoauth_yahoo_guid = $response['xoauth_yahoo_guid'];
	  $this->verifier = $verifier;
	
	  return $response;
	} catch( \OAuthException $e ) {
	  $error = 'Error: ' . $e->getMessage() . "\n";
	  $error .= 'Response: ' . $e->lastResponse . "\n";
	  return false;
	}
  }

	//process the request
  function getRequest ($access_token, $access_token_secret, $url){
	$o = new \OAuth( $this->key, $this->secret, OAUTH_SIG_METHOD_HMACSHA1, OAUTH_AUTH_TYPE_URI );
	$o->enableDebug();
	// Try to make request using stored token
	try {
	  $o->setToken($access_token, $access_token_secret);
	  if( $o->fetch(  $url ) ) {
	    $result = $o->getLastResponse();
		return $result;
	    exit;
	  } else {
	    return FALSE;
	  }
	} catch(\OAuthException $e ) {
	  $error = 'Error: ' . $e->getMessage() . "\n";
	  $error .=  'Error Code: ' . $e->getCode() . "\n";
	  $error .=  'Response: ' . $e->lastResponse . "\n";
	  if( $e->getCode() == 401 ) {
	    return false;
	  }
	}
  }	


}