<div class="wrap">
    <h2>Twit Post Options</h2>
    <form method="post" action="options.php">
        <?php settings_fields( 'twit_blog_options' ); ?>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label for="twit_blog_post_author">Author</label></th>
                    <td><input type="text" name="twit_blog_post_author" value="<?php echo get_option('twit_blog_post_author'); ?>" class="regular-text" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="twit_blog_post_category">Category</label></th>
                    <td><input type="text" name="twit_blog_post_category" value="<?php echo get_option('twit_blog_post_category'); ?>" class="regular-text"/></td>
                </tr>
              </tbody>
        </table>
        <p class="submit"><input type="submit" id="submit" value="<?php _e('Save Changes') ?>" class="button-primary" /></p>
    </form>
</div>
