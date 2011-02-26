<div class="wrap">
    <h2>Twit Post Options</h2>
    <form method="post" action="options.php">
        <?php settings_fields( 'twit_blog_options' ); ?>
        
        <h3>OAuth Options</h3>
        
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
        
        <p class="submit"><input type="submit" id="submit" value="Connect To Twitter" class="button-primary" /></p>
    </form>
    
</div>


