<?php
/*
Plugin Name: Twit Blog
Plugin URI: http://www.craig-russell.co.uk
Description: A plugin to create blog posts form the favourites on a twitter account
Version: 0.1
Author: Craig Russell
Author URI: http://www.craig-russell.co.uk
License: MIT

Copyright (c) 2011 Craig Russell

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

/* Main Function */
add_action('init','hello_world');

function hello_world(){
    echo get_option('hello_world_data');
}

/* Options */
register_activation_hook(__FILE__,'hello_world_install');
register_deactivation_hook( __FILE__, 'hello_world_remove' );

function hello_world_install() {
    add_option("hello_world_data", 'Default', '', 'yes');
}

function hello_world_remove(){
    delete_option("hello_world_data");
}

/* Settings Page */
if(is_admin()){
    add_action('admin_menu','hello_world_admin_menu'); 
}

function hello_world_admin_menu(){
    add_options_page('Hello World', 'Hello World', 'administrator', 'hello-world', 'hello_world_html_page');
}

function hello_world_html_page() { ?>
    <div>
        <h2>Hello World Options</h2>
        <form method="post" action="options.php">
            <?php wp_nonce_field('update-options'); ?>
            <input name="hello_world_data" type="text" id="hello_world_data" value="<?php echo get_option('hello_world_data'); ?>" />
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="page_options" value="hello_world_data" />
            <input type="submit" value="<?php _e('Save Changes') ?>" />
        </form>
    </div>
<?php } ?>

