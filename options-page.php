<div class="wrap">
    <?php screen_icon(); echo "<h2>Twit Blog Options</h2>";?>
    <form method="post" action="options.php">
        <?php settings_fields( 'twit_blog_options' ); ?>
        <h3>Twitter Options</h3>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label for="twit_blog_twitter_account">Twitter User</label></th>
                    <td>
                        <input type="text" name="twit_blog_twitter_account" class="regular-text" value="<?php echo get_option( 'twit_blog_twitter_account' ); ?>"/>
                        <span class="description">Blog tweets from this twitter account</span>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Blog Tweets<br/></th>
                    <td>
                        <span class="description">Choose which tweets to blog</span>
                        <fieldset>
                            <label><input type="radio" name="twit_blog_twitter_data" value="none" <?php echo twit_blog_twitter_data_checked('none'); ?>/><span>None (off)</span></label><br/>
                            <label><input type="radio" name="twit_blog_twitter_data" value="user_timeline" <?php echo twit_blog_twitter_data_checked('user_timeline'); ?>/><span>User timeline</span></label><br/>
                            <label><input type="radio" name="twit_blog_twitter_data" value="mentions" <?php echo twit_blog_twitter_data_checked('mentions'); ?>/><span>Mentions</span></label><br/>
                            <label><input type="radio" name="twit_blog_twitter_data" value="retweeted_by_me" <?php echo twit_blog_twitter_data_checked('retweeted_by_me'); ?>/><span>Retweeted by me</span></label><br/>
                            <label><input type="radio" name="twit_blog_twitter_data" value="retweeted_to_me" <?php echo twit_blog_twitter_data_checked('retweeted_to_me'); ?>/><span>Retweeted to me</span></label><br/>
                            <label><input type="radio" name="twit_blog_twitter_data" value="retweets_of_me" <?php echo twit_blog_twitter_data_checked('retweets_of_me'); ?>/><span>Retweets of me</span></label><br/>
                            <label><input type="radio" name="twit_blog_twitter_data" value="favourites" <?php echo twit_blog_twitter_data_checked('favourites'); ?>/><span>Favourites</span></label><br/>
                            <!--<label><input type="radio" name="twit_blog_twitter_data" value="custom" <?php echo twit_blog_twitter_data_checked('custom'); ?>/><span>Custom filter:</span></label>
                            <input type="text" name="twit_blog_twitter_data_custom" value="<?php echo get_option( 'twit_blog_twitter_data_custom' ); ?>"/>
                            <span class="description">Any tweet in above account containing this text</span><br/>-->
                        </fieldset>
                    </td>
                </tr>
              </tbody>
        </table>
        
        <h3>Post Options</h3>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label for="twit_blog_post_author">Post Author</label></th>
                    <td>
                        <select type="text" name="twit_blog_post_author" class="regular-text">
                        <?php
                            foreach(twit_blog_get_users() as $user){
                                if ( $user->ID == get_option('twit_blog_post_author') ) {
                                    echo '<option value="'.$user->ID.'" selected="selected">'.ucwords($user->user_nicename).'</option>';
                                }else{
                                    echo '<option value="'.$user->ID.'" >'.ucwords($user->user_nicename).'</option>';
                                }
                            }
                        ?>
                        </select>
                        <span class="description">Choose the author to post as</span>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="twit_blog_post_category">Category</label></th>
                    <td>
                        <select type="text" name="twit_blog_post_category" class="regular-text">
                        <?php
                            foreach(get_categories(array( 'hide_empty' => 0 )) as $category){
                                if ( $category->cat_ID == get_option('twit_blog_post_category') ) {
                                    echo '<option value="'.$category->cat_ID.'" selected="selected">'.ucwords($category->category_nicename).'</option>';
                                }else{
                                    echo '<option value="'.$category->cat_ID.'" >'.ucwords($category->category_nicename).'</option>';
                                }
                            }
                        ?>
                        </select>
                        <span class="description">Select category to create posts in</span>
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


