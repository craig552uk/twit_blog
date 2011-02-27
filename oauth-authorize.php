<?php
/* Start session and load libraries. */
session_start();
include_once("../../../wp-load.php"); /* Loads Wordpress functions */
include_once('twitteroauth/twitteroauth.php');
include_once('functions.php');

/* Get POST data */
$consumer_key    = ( isset($_POST['twit_blog_consumer_key']) ) ? $_POST['twit_blog_consumer_key'] : '';
$consumer_secret = ( isset($_POST['twit_blog_consumer_secret']) ) ? $_POST['twit_blog_consumer_secret'] : '';

/* Store Return URL */
if (isset($_POST['twit_blog_return_url'])){
    $_SESSION['return_url'] = $_POST['twit_blog_return_url'];
}

/* Set callback URL */
$oauth_callback  = curPageURL();

/* Get last authentication step from session or default to 0 */
$oauth_step = ( isset($_SESSION['oauth_step']) ) ? $_SESSION['oauth_step'] : 0;

if(!isset($_GET['oauth_verifier'])){
    /* Get request token */
    $connection = new TwitterOAuth($consumer_key, $consumer_secret);
    $request_token = $connection->getRequestToken($oauth_callback);
    
    $_SESSION['oauth_token']        = $request_token['oauth_token'];
    $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
    
    update_option('twit_blog_consumer_key', $consumer_key);
    update_option('twit_blog_consumer_secret', $consumer_secret);
    
    if ( 200 == $connection->http_code ) {        
        /* Redirect to Service Provider login */
        $url = $connection->getAuthorizeURL($request_token['oauth_token']);
        header('Location: ' . $url);                        
    }else{        
        /* Redirect back to oauth-page with error */
        header('Location: ' . $_SESSION['return_url'] . '&error=bad_codes');
    }
}else{
    /* Handle response, then get access token */
    $connection = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
    $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);   
    
    $return_url = $_SESSION['return_url'];
    
    /* Clear data from session */    
    unset($_SESSION['oauth_token']);
    unset($_SESSION['oauth_token_secret']);
    unset($_SESSION['return_url']);

    /* Authorized: Store token data */        
    update_option('twit_blog_token_key', $access_token['oauth_token']);
    update_option('twit_blog_token_secret', $access_token['oauth_token_secret']);
    update_option('twit_blog_oauth_authorized', true);
    
    //echo '<pre>'; print_r($_REQUEST); print_r($access_token); echo '</pre>';
    
    /* Return to Wordpress */
    header('Location: ' . $return_url );
}
