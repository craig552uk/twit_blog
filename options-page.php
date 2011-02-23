<div class="wrap">
    <h2>Hello World Options</h2>
    <form method="post" action="options.php">
        <?php wp_nonce_field('update-options'); ?>
        <label for="twit_blog_data">Data</label>
        <input name="twit_blog_data" type="text" id="twit_blog_data" value="<?php echo get_option('twit_blog_data'); ?>" />
        <input type="hidden" name="action" value="update" />
        
        <label for="twit_blog_post_author">Author</label>
        <input name="twit_blog_post_author" type="text" id="twit_blog_post_author" value="<?php echo get_option('twit_blog_post_author'); ?>" />
        
        <label for="twit_blog_post_category">Category</label>
        <input name="twit_blog_post_category" type="text" id="twit_blog_post_category" value="<?php echo get_option('twit_blog_post_category'); ?>" />
        
        <input type="hidden" name="page_options" value="twit_blog_data,twit_blog_post_author,twit_blog_post_category" />
        <input type="submit" value="<?php _e('Save Changes') ?>" />
    </form>
</div>
