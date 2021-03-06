<?php
/*
    Core Plugin functions
*/

/*
    --- DEPRECATED --- Now using wp_schedule_event() ---
    Checks to see if the last update was longer then X seconds ago
    If so return true and resets the clock
    Otherwise return false
    
    @return boolean
*/
function twit_blog_can_update(){
    if ( (date('UTC') - get_option('twit_blog_last_update')) > get_option('twit_blog_update_delay') ) {
        update_option('twit_blog_last_update', date('UTC'));
        return true;
    }else{
        return false;
    }
}

/*
    Parses plain text adding HTML links to URLs and twitter usernames
    
    @param  string Plain text
    @return string Parsed text
*/
function parseLinks($text){
    $text = preg_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)', '<a href="$0">$0</a>', $text); /* Links */
    //$text = preg_replace('/@[a-zA-Z0-9_-]+/', '<a href="http://twitter.com/$0">$0</a>', $text); /* Twitter Users */
    return $text;
}
    
/*
    Inserts a new blog post with the specified content identified as being by the specified author
    
    @param tweet object returned from REST API
*/
function twit_blog_insert_post($tweet){
    /* Assemble post data */
    $new_post = array(
        'post_title' => "Tweet from @".$tweet->user->screen_name,
        'post_content' => parseLinks($tweet->text),
        'post_author' => get_option('twit_blog_post_author'),
        'post_category' => explode(',',get_option('twit_blog_post_category')),
        'post_date' => date('Y-m-d H:i:s'),
        'post_status' => 'publish'
    );
    
    /* Create post */
    $id = wp_insert_post($new_post);
    
    /* Save tweet data in post meta */
    add_post_meta($id, 'user_screen_name', $tweet->user->screen_name );
    add_post_meta($id, 'user_profile_image_url', $tweet->user->profile_image_url );
    add_post_meta($id, 'id_str', $tweet->id_str );
    add_post_meta($id, 'created_at', $tweet->created_at);
}
   
/*
    Return the current page url
    http://www.webcheatsheet.com/PHP/get_current_page_url.php
*/
function curPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

/*
    Get array of user data
    
    @return array
*/
function twit_blog_get_users(){
    global $wpdb;
    $return = array();
    $userIDs = $wpdb->get_col( $wpdb->prepare("SELECT $wpdb->users.ID FROM $wpdb->users ORDER BY %s ASC", 'user_nicename' ) );
    foreach ( $userIDs as $userID ){
        $return[] = get_userdata($userID);
    }
    return $return;
}

/*
    Set default option for twit_blog_twitter_data
    
    @param string the value being tested
    @return string 'checked="checked"' if value is selected
*/
function twit_blog_twitter_data_checked($value){
    if ( $value == get_option( 'twit_blog_twitter_data' ) ){
        return 'checked="checked"';
    }
}
