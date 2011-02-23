<div>
    <h2>Hello World Options</h2>
    <form method="post" action="options.php">
        <?php wp_nonce_field('update-options'); ?>
        <input name="twit_blog_data" type="text" id="twit_blog_data" value="<?php echo get_option('twit_blog_data'); ?>" />
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="page_options" value="twit_blog_data" />
        <input type="submit" value="<?php _e('Save Changes') ?>" />
    </form>
</div>
