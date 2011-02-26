<?php
/* Set defaults if necessary */
$_REQUEST['settings-updated'] = ($_REQUEST['settings-updated']) ? true : false;
$_REQUEST['error'] = ($_REQUEST['error']) ? $_REQUEST['error'] : '';

if ( $_REQUEST['settings-updated'] ) {
    echo '<p>'.get_option('twit_blog_consumer_key').'</p>';
    echo '<p>'.get_option('twit_blog_consumer_secret').'</p>';
    echo '<p>'.curPageURL().'</p>'; 
}

print_r( $_REQUEST );

include( 'oauth-page.php' );
