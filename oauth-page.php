<?php
    /* Set defaults if necessary */
    $_REQUEST['updated'] = ($_REQUEST['updated']) ? true               : false;
    $_REQUEST['error']   = ($_REQUEST['error'])   ? $_REQUEST['error'] : '';
    
    if ( $_REQUEST['updated'] ) {
        echo '<p>'.get_option('twit_blog_consumer_key').'</p>';
        echo '<p>'.get_option('twit_blog_consumer_secret').'</p>';
    }
?>

<div class="wrap">
    <?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options' ) . "</h2>"; ?>
    
    <?php if( 'oauth_error' == $_REQUEST['error'] ) : ?>
        <div id="setting-error-oauth_error" class="error settings-error">
            <p><strong>Cannot connect to Twitter, please try again later.</strong></p>
        </div>
    <?php endif; ?>
    
    <form method="post" action="options.php">
        <?php settings_fields( 'twit_blog_options' ); ?>
        
        <p>To use this plugin you will need a Twitter API key. Getting one is easy, follow these steps...</p>
        
        <ol>
            <li>Go to Twitter and register a <a href="https://dev.twitter.com/apps/new">new application</a></li>
            <li>Name it <strong>TwitBlog</strong></li>
            <li>Set the URL to <strong><?php echo site_url(); ?></strong></li>
            <li>Copy the Consumer Key and Consumer Secret below</li>
            <li>Click <strong>Connect To Twitter</strong></li>
        </ol>
        
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label for="twit_blog_consumer_key">Consumer Key</label></th>
                    <td>
                        <input type="text" name="twit_blog_consumer_key" value="<?php echo get_option('twit_blog_consumer_key'); ?>" class="regular-text" />
                        <span class="description">OAuth Consumer Key from Twitter</span>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="twit_blog_consumer_secret">Consumer Secret</label></th>
                    <td>
                        <input type="text" name="twit_blog_consumer_secret" value="<?php echo get_option('twit_blog_consumer_secret'); ?>" class="regular-text"/>
                        <span class="description">OAuth Consumer Secret from Twitter</span>
                    </td>
                </tr>
              </tbody>
        </table>
        
        <input type="hidden" name="twit_blog_return_url" value="<?php echo curPageURL();?>" />
        
        <p class="submit"><input type="submit" id="submit" value="Connect To Twitter" class="button-primary" /></p>
    </form>
    
</div>


