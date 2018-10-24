<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('after_setup_theme','crb_load');
function crb_load ()
{
    require_once(__DIR__ . '/vendor/autoload.php');
    \Carbon_Fields\Carbon_Fields::boot();
}

add_action('carbon_fields_register_fields','my_plugin_attach_product_options');
function my_plugin_attach_product_options ()
{
    Container::make('post_meta',__('Product field','crb'))
        ->where('post_type','=','product')
        ->add_fields(array(
            Field::make('text','my_plugin_name','Name')
                ->set_attribute('maxLength',255),
            Field::make('text','my_plugin_desc','Description')
                ->set_attribute('maxLength',255),
            Field::make('text','my_plugin_price','Price')
                ->set_attribute('type','number')
                ->set_attribute('min',0),
            Field::make('radio','my_plugin_content_align','Status')
                ->add_options(array(
                    'yes'=>'In store',
                    'no'=>'Out store',
                )),
            Field::make('complex','my_plugin_attr','Attributes')
                ->add_fields(array(
                    Field::make('text','name','Name'),
                    Field::make('text','value1','Value'),
                ))
        ));
}

add_filter('manage_posts_columns','plugin_columns_head',10,2);
function plugin_columns_head ($posts_columns,$post_type)
{
    if($post_type==='product'){
        $posts_columns['prod_name']='Name';
        $posts_columns['prod_price']='Price';
        $posts_columns['prod_status']='Status';
    }

    return $posts_columns;
}

add_action('manage_posts_custom_column','plugin_columns_content',10,2);

function plugin_columns_content ($column_name,$post_ID)
{
    if($column_name=='prod_name'){
        $post_name=carbon_get_the_post_meta('my_plugin_name');
        echo $post_name;
    } elseif($column_name=='prod_price') {
        $post_price=carbon_get_the_post_meta('my_plugin_price');
        echo $post_price;
    } elseif($column_name=='prod_status') {
        $post_status=carbon_get_the_post_meta('my_plugin_content_align');
        $checked=($post_status=='yes')?'checked':'';
        echo '<input class="status-store" id="' . $post_ID . '" type="checkbox"' . $checked . '>';
    }
}

add_action('wp_ajax_plugin_ajax_func','plugin_ajax_func');

function plugin_ajax_func ()
{
    $check=carbon_get_post_meta($_POST['checkId'],'my_plugin_content_align');
    if($check==='no'){
        update_post_meta($_POST['checkId'],'_my_plugin_content_align','yes');
    } elseif($check==='yes') {
        update_post_meta($_POST['checkId'],'_my_plugin_content_align','no');
    }
    die();
}

