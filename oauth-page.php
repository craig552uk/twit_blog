<div class="wrap">
    <?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options' ) . "</h2>"; ?>
    
    <?php if( isset( $_GET['error'] ) ) : ?>
        <div id="setting-error-oauth_error" class="error settings-error">
            <p><strong>Cannot Connect to Twitter. Please check your codes and try again.</strong></p>
        </div>
    <?php endif; ?>
    
    <?php print_r($_SESSION); ?>
    
    <form method="post" action="<?php echo home_url(); ?>/wp-content/plugins/wp_twitblog/oauth-authorize.php">
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


