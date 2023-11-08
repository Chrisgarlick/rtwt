<?php

/*******************
* CUSTOM POST TYPES
*******************/

global $custom_ptypes;
$custom_ptypes = [
    [
        'singular' => 'Resource',
        'plural' => 'Resources',
        'icon' => 'dashicons-analytics',
        'name' => 'resources',
        'archive' => false,
        'supports' => ['title', 'thumbnail'],
        'tags' => false,
        'acf_id' => false,
        'slug' => 'resource'
    ], 
    [
        'singular' => 'Testimonial',
        'plural' => 'Testimonials',
        'icon' => 'dashicons-groups',
        'name' => 'testimonials',
        'archive' => false,
        'supports' => ['title', 'thumbnail', 'excerpt'],
        'tags' => false,
        'acf_id' => false,
        'slug' => 'testimonial'
    ], 
    [
        'singular' => 'FAQ',
        'plural' => 'FAQs',
        'icon' => 'dashicons-format-chat',
        'name' => 'faq',
        'archive' => false,
        'supports' => ['title', 'editor'],
        'tags' => false,
        'acf_id' => false,
        'slug' => false
    ]
];

function register_posttype() {
    global $custom_ptypes;
    
    foreach($custom_ptypes as $pt) { 
        $singular = $pt['singular'];
        $plural = $pt['plural'];
        $icon = $pt['icon'];
        $name = $pt['name'];
        $archive = $pt['archive'] ? $pt['archive'] : false;
        $supports = $pt['supports'] ? $pt['supports'] : ['title', 'revisions', 'thumbnail', 'editor'];
        $tags = [];
        $tags = $pt['tags'] ? ['post_tag'] : [];
        $acf_id = $pt['acf_id'] ? $pt['acf_id'] : true;
        $rewrite = $pt['slug'] ? ['with_front' => false, 'slug' => $pt['slug']] : false;
        $public = $pt['slug'] ? true : false;
        
        $labels = [
            'name'               => $plural,
            'singular_name'      => $singular,
            'menu_name'          => $plural,
            'name_admin_bar'     => $singular,
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New '.$singular,
            'new_item'           => 'New '.$singular,
            'edit_item'          => 'Edit '.$singular,
            'view_item'          => 'View '.$singular,
            'all_items'          => 'All '.$plural,
            'search_items'       => 'Search '.$plural,
            'parent_item_colon'  => 'Parent '.$singular.':',
            'not_found'          => 'No '.$plural.' found.',
            'not_found_in_trash' => 'No '.$plural.' found in Bin.'
        ];

        $args = [
            'labels'             => $labels,
            'public'             => $public,
            'publicly_queryable' => $public,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => $rewrite,
            'capability_type'    => 'post',
            'has_archive'        => $archive,
            'hierarchical'       => true,
            'menu_position'      => 5,
            'menu_icon'          => $icon,
            'supports'           => $supports,
            'taxonomies'         => $tags
        ];

        if($archive && function_exists('acf_add_options_page')) {
            acf_add_options_page([
                'page_title'  => $plural.' Archive',
                'menu_title'  => $plural.' Archive',
                'menu_slug'   => 'cd-options-archive-'.$name,
                'parent_slug' => 'edit.php?post_type='.$name,
                'post_id' => 'acf_'.$acf_id
            ]);
        }

        register_post_type( $name, $args );
    }
}
add_action('init', 'register_posttype');

/*******************
* CUSTOM TAXONOMIES
*******************/

function create_taxonomies() {
    
    register_taxonomy('subject', ['resources'],
        [
            'labels' => [
                'name' => __('Subjects', 'cg-theme'),
                'singular_name' => __('Subject', 'cg-theme')
            ],
            'description' => false,
            'hierarchical' => true,
            'query_var' => true,
            'show_in_nav_menus' => true,
            'publicly_queryable' => false
        ]
    );

    register_taxonomy('type', ['testimonials'],
        [
            'labels' => [
                'name' => __('Type', 'cg-theme'),
                'singular_name' => __('Type', 'cg-theme')
            ],
            'hierarchical' => true,
            'query_var' => true,
            'show_in_nav_menus' => true
        ]
    );

    register_taxonomy('faq-category', ['faq'],
        [
            'labels' => [
                'name' => __('FAQ Categories', 'cg-theme'),
                'singular_name' => __('FAQ Category', 'cg-theme')
            ],
            'hierarchical' => false,
            'query_var' => true,
            'show_in_nav_menus' => true,
            'publicly_queryable' => false
        ]
    );
}
add_action('init',  'create_taxonomies');

/*******************
* REGISTER SIDEBARS/WIDGETS AREAS
*******************/

function widgets_init() {
	register_sidebar([
	  'name'          => __('Shop Sidebar', 'cg-theme'),
	  'id'            => 'shop-sidebar',
	  'before_widget' => '<section class="%1$s %2$s">',
	  'after_widget'  => '</section>',
      'before_title'  => '<h3 class="c__collpase-toggle open">',
	  'after_title'   => '</h3>'
    ]);
}
//add_action('widgets_init', 'widgets_init');
  