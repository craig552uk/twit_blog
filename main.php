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

/* Included functions library */
include('functions').php;

/* Main Bootstrap Function */
add_action('init','twit_blog');

function twit_blog(){
    echo get_option('twit_blog_data');
}

/* Plugin Setup & Cleanup */
register_activation_hook(__FILE__,'twit_blog_install');
register_deactivation_hook( __FILE__, 'twit_blog_remove' );

function twit_blog_install() {
    add_option("twit_blog_data", 'Default', '', 'yes')
    add_option("twit_blog_last_update", date('UTC'), '', 'yes');
    add_option("twit_blog_update_delay", '60', '', 'yes');
}

function twit_blog_remove(){
    delete_option("twit_blog_data");
    delete_option("twit_blog_last_update");
    delete_option("twit_blog_update_delay");
}

/* Plugin Settings Page */
if(is_admin()){ add_action('admin_menu','twit_blog_options_page'); }
function twit_blog_options_page() { add_options_page('Twit Blog', 'Twit Blog', 'administrator', 'twit-blog', 'twit_blog_options_html'); }
function twit_blog_options_html() { include('settings.php'); }

