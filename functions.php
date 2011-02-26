<?php
/*
    Core Plugin functions
*/

/*
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
    $text = preg_replace('/@[a-zA-Z0-9_-]+/', '<a href="http://twitter.com/$0">$0</a>', $text); /* Twitter Users */
    return $text;
}
    
/*
    Inserts a new blog post with the specified content identified as being by the specified author
    
    @param string post content
*/
function twit_blog_insert_post($tw_content, $tw_author){
    $new_post = array(
        'post_title' => "Tweet from $tw_author",
        'post_content' => $tw_content,
        'post_author' => get_option('twit_blog_post_author'),
        'post_category' => explode(',',get_option('twit_blog_post_category')),
        'post_status' => 'publish'
    );
    wp_insert_post($new_post);
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
