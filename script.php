<?php

add_action('admin_enqueue_scripts','admin_load_script');
function admin_load_script ()
{
    wp_enqueue_script('my-wp-admin',plugin_dir_url(__FILE__) . '/js/wp-admin.js');
}