<div class="wrap">
    <?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options' ) . "</h2>";?>
    <form method="post" action="options.php">
        <?php settings_fields( 'twit_blog_options' ); ?>
        <h3>Post Options</h3>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label for="twit_blog_post_author">Post Author</label></th>
                    <td>
                        <input type="text" name="twit_blog_post_author" value="<?php echo get_option('twit_blog_post_author'); ?>" class="regular-text" />
                        <span class="description">Choose the author to post as</span>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="twit_blog_post_category">Category</label></th>
                    <td>
                        <input type="text" name="twit_blog_post_category" value="<?php echo get_option('twit_blog_post_category'); ?>" class="regular-text"/>
                        <span class="description">Select categories to create posts in</span>
                    </td>
                </tr>
              </tbody>
        </table>
        
        <h3>OAuth Options</h3>
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
        
        <p class="submit"><input type="submit" id="submit" value="<?php _e('Save Changes') ?>" class="button-primary" /></p>
    </form>
    
</div>


