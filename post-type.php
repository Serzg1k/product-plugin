<?php
add_action('init', 'pt_register_post_types');

function pt_register_post_types() {
    $post_types = array(
        array(
            'slug'  => 'product',
            'label' => 'Product'
        ),
    );
    foreach ($post_types as $post_type) {
        register_post_type($post_type['slug'],[
            'label'              =>null,
            'labels'             =>[
                'name'              =>$post_type['label'],
                'singular_name'     =>$post_type['label'],
                'add_new'           =>'add ' . $post_type['label'],
                'add_new_item'      =>'add ' . $post_type['label'],
                'edit_item'         =>'edit ' . $post_type['label'],
                'new_item'          =>'new ' . $post_type['label'],
                'view_item'         =>'view ' . $post_type['label'],
                'search_items'      =>'search ' . $post_type['label'],
                'not_found'         =>'not found',
                'not_found_in_trash'=>'not found in trash',
                'parent_item_colon' =>'',
                'menu_name'         =>$post_type['label'],
            ],
            'description'        =>'',
            'public'             =>true,
            'publicly_queryable' =>null,
            'exclude_from_search'=>null,
            'show_ui'            =>null,
            'show_in_menu'       =>null,
            'show_in_admin_bar'  =>null,
            'show_in_nav_menus'  =>null,
            'show_in_rest'       =>null,
            'rest_base'          =>null,
            'menu_position'      =>null,
            'hierarchical'       =>false,
            'supports'           =>['title'],
            'taxonomies'         =>[],
            'has_archive'        =>true,
            'rewrite'            =>true,
            'query_var'          =>true,
        ]);
    }
    register_taxonomy('taxonomy', array('product'), array(
        'label'                 => 'Attr',
        'labels'                => array(
            'name'              => 'Attr',
            'singular_name'     => 'Attr',
            'search_items'      => 'Search Attrs',
            'all_items'         => 'All Attrs',
            'view_item '        => 'View Attrs',
            'parent_item'       => 'Parent Attr',
            'parent_item_colon' => 'Parent Attr:',
            'edit_item'         => 'Edit Attr',
            'update_item'       => 'Update Attr',
            'add_new_item'      => 'Add New Attr',
            'new_item_name'     => 'New Attr Name',
            'menu_name'         => 'Attr',
        ),
        'description'           => '',
        'public'                => true,
        'publicly_queryable'    => null,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_tagcloud'         => true,
        'show_in_rest'          => null,
        'rest_base'             => null,
        'hierarchical'          => true,
        'update_count_callback' => '',
        'rewrite'               => true,
        'capabilities'          => array(),
        'meta_box_cb'           => null,
        'show_admin_column'     => false,
        '_builtin'              => false,
        'show_in_quick_edit'    => null,
    ) );
}