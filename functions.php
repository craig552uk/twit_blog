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

function twit_blog_insert_post($content){
    // Create post object
    $new_post = array(
        'post_title' => 'My post',
        'post_content' => $content,
        'post_status' => 'publish'
    );

    // Insert the post into the database
    wp_insert_post($new_post);
}
