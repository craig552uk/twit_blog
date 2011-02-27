<?php
/*
Plugin Name: Twit Blog
Plugin URI: http://www.craig-russell.co.uk
Description: A plugin to create blog posts form the favourites on a twitter account
Version: 0.1
Author: Craig Russell
Author URI: http://www.craig-russell.co.uk
License: MIT

Copyright (c) 2011 Craig Russell

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the 'Software'), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

/* Included functions library */
include( 'functions.php' );
include_once( 'twitteroauth/twitteroauth.php' );

/* Main Bootstrap Function */
add_action( 'init','twit_blog' );

function twit_blog(){
    if ( get_option('twit_blog_oauth_authorized') ) {
        /* Authorized */

        if ( twit_blog_can_update() ) {
            /* Connect to Twitter */
            $connection = new TwitterOAuth(get_option('twit_blog_consumer_key'), get_option('twit_blog_consumer_secret'), get_option('twit_blog_token_key'), get_option('twit_blog_token_secret'));
            
            /* Get Tweets */
            if ( 'user_timeline' == get_option( 'twit_blog_twitter_data' ) ) {
                $result = $connection->get('statuses/user_timeline');
            }elseif ( 'friends_timeline' == get_option( 'twit_blog_twitter_data' ) ) {
                $result = $connection->get('statuses/friends_timeline');
            }elseif ( 'mentions' == get_option( 'twit_blog_twitter_data' ) ) {
                $result = $connection->get('statuses/mentions');
            }elseif ( 'retweeted_by_me' == get_option( 'twit_blog_twitter_data' ) ) {
                $result = $connection->get('statuses/retweeted_by_me');
            }elseif ( 'retweeted_to_me' == get_option( 'twit_blog_twitter_data' ) ) {
                $result = $connection->get('statuses/retweeted_to_me');
            }elseif ( 'retweets_of_me' == get_option( 'twit_blog_twitter_data' ) ) {
                $result = $connection->get('statuses/retweets_of_me');
            }elseif ( 'favourites' == get_option( 'twit_blog_twitter_data' ) ) {
                $result = $connection->get('favorites/'.get_option('twit_blog_twitter_account'));
            }
            
            /* Default empty array if needed */
            if (!is_array($result)) { $result = array(); }
            
            /* Filter results */
            $tmp_result = array();
            foreach ( $result as $tweet ){
                if ( 0 != substr_count( strtoupper($tweet->text), strtoupper(get_option( 'twit_blog_twitter_data_custom' ) ) ) ) {
                    //echo '<p>'.substr_count( $tweet->text, get_option( 'twit_blog_twitter_data_custom' ) ).' "'.get_option( 'twit_blog_twitter_data_custom' ).'" "'.$tweet->text.'"</p>';
                    $tmp_result[] = $tweet;
                }
            }
            $result = $tmp_result;
            
            foreach ( array_reverse($result) as $tweet ) {
                
                /* If tweet is new */
                if ( 0 == substr_count( get_option( 'twit_blog_post_id_list' ), $tweet->id_str ) ) {
                
                    /* Create Blog Post */
                    twit_blog_insert_post( $tweet );
                    
                    /* Store tweet id in list */
                    $list = $tweet->id_str.','.get_option( 'twit_blog_post_id_list' );
                    update_option( 'twit_blog_post_id_list', $list );
                }
            }            
            //echo '<pre>'; print_r($result); echo '</pre>'; /* Show twitter response data */
        } 
    }
}
 
/* Plugin Setup & Cleanup */
register_activation_hook( __FILE__,'twit_blog_install' );
register_deactivation_hook( __FILE__, 'twit_blog_remove' );

function twit_blog_install() {
    add_option( 'twit_blog_last_update', date('UTC'), '', 'yes' );
    add_option( 'twit_blog_update_delay', '60', '', 'yes' );
    add_option( 'twit_blog_post_id_list', '', '', 'yes' );
    add_option( 'twit_blog_post_author', '0', '', 'yes' );
    add_option( 'twit_blog_post_category', '0', '', 'yes' );
    add_option( 'twit_blog_consumer_key', '', '', 'yes' );
    add_option( 'twit_blog_consumer_secret', '', '', 'yes' );
    add_option( 'twit_blog_token_key', '', '', 'yes' );
    add_option( 'twit_blog_token_secret', '', '', 'yes' );
    add_option( 'twit_blog_oauth_authorized', '0', '', 'yes' );
    add_option( 'twit_blog_twitter_account', '', '', 'yes' );
    add_option( 'twit_blog_twitter_data', 'none', '', 'yes' );
    add_option( 'twit_blog_twitter_filter', '', '', 'yes' );
}

function twit_blog_remove(){
    delete_option( 'twit_blog_last_update' );
    delete_option( 'twit_blog_update_delay' );
    delete_option( 'twit_blog_post_id_list' );
    delete_option( 'twit_blog_post_author' );
    delete_option( 'twit_blog_post_category' );
    delete_option( 'twit_blog_consumer_key' );
    delete_option( 'twit_blog_consumer_secret' );
    delete_option( 'twit_blog_token_key' );
    delete_option( 'twit_blog_token_secret' );
    delete_option( 'twit_blog_oauth_authorized' );
    delete_option( 'twit_blog_twitter_account' );
    delete_option( 'twit_blog_twitter_data' );
    delete_option( 'twit_blog_twitter_filter' );
}

/* Plugin Settings Page */
if(is_admin()){ add_action( 'admin_menu','twit_blog_options_page' ); }

function twit_blog_register_settings(){
    register_setting( 'twit_blog_options', 'twit_blog_post_author' );
    register_setting( 'twit_blog_options', 'twit_blog_post_category' );
    register_setting( 'twit_blog_options', 'twit_blog_consumer_key' );
    register_setting( 'twit_blog_options', 'twit_blog_consumer_secret' );
    register_setting( 'twit_blog_options', 'twit_blog_twitter_data' );
    register_setting( 'twit_blog_options', 'twit_blog_twitter_filter' );
}

function twit_blog_options_page() {
    add_options_page( 'Twit Blog', 'Twit Blog', 'administrator', 'twit-blog-options', 'twit_blog_options_html' );
    add_action( 'admin_init', 'twit_blog_register_settings' );
}

function twit_blog_options_html() {
    global $error_strings;
    
    if ( get_option('twit_blog_oauth_authorized') ) {
        include( 'options-page.php' );
    }else{
        include( 'oauth-page.php' );
    }
}

/* Plugin settings link on Plugins list */

add_filter('plugin_action_links', 'twit_blog_settings_link', 10, 2 );

function twit_blog_settings_link($links, $file){
    static $this_plugin;
    if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);

    if ($file == $this_plugin){
        $settings_link = '<a href="options-general.php?page=twit-blog-options">Settings</a>';
        array_unshift($links, $settings_link);
    }
    return $links;
}

