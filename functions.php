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
function is_update(){
    if ( (date('UTC') - get_option('twit_blog_last_update')) > get_option('twit_blog_update_delay') ) {
        update_option('twit_blog_last_update', date('UTC'));
        return true;
    }else{
        return false;
    }
}

