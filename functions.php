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
function twit_blog_is_update(){
    if ( (date('UTC') - get_option('twit_blog_last_update')) > get_option('twit_blog_update_delay') ) {
        update_option('twit_blog_last_update', date('UTC'));
        return true;
    }else{
        return false;
    }
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
        'post_category' => explode('|', get_option('twit_blog_post_category')),
        'post_status' => 'publish'
    );
    wp_insert_post($new_post);
}
