<?php
// functions.php

require_once('lib/timber.php');
require_once('lib/tools.php');
require_once('lib/posttypes.php');
require_once('lib/ajax.php');

function custom_acf_json_save_point( $path ) {
    // Set the path to the acf-json folder in your theme
    return get_stylesheet_directory() . '/acf-json';
}
add_filter('acf/settings/save_json', 'custom_acf_json_save_point');

function custom_acf_json_load_point( $paths ) {
    // Add the path to the acf-json folder in your theme
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}
add_filter('acf/settings/load_json', 'custom_acf_json_load_point');

function enqueue_theme_scripts() {
    // Deregister the default version of jQuery provided by WordPress
    wp_deregister_script('jquery');

    // Register and enqueue jQuery from an external source
    wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js", array(), null, true);
    wp_enqueue_script('jquery');

    wp_register_script('fontawesome', "https://kit.fontawesome.com/ca004fe30a.js", array(), null, true);
    wp_enqueue_script('fontawesome');

    wp_enqueue_style("slick-carousel", get_template_directory_uri() . '/assets/src/css/slick.css');
    wp_enqueue_script('slick-carousel', get_template_directory_uri() . '/assets/src/js/slick.min.js', array('jquery'), '1.0', true);
    // Enqueue your custom script with 'slick' as a dependency
    wp_enqueue_script( 'cg_base-script', get_template_directory_uri() . '/assets/dist/js/scripts.min.js', ['jquery'], '1.0.0', true );
    wp_enqueue_style( 'cg_base-style', get_template_directory_uri() . '/assets/dist/css/styles.min.css', array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_theme_scripts' );


// add_theme_support('post-thumbnails');

// function cg_base_register_menus() {
//     register_nav_menus(
//         array(
//             'top_nav' => 'Top Menu',
//             'main_nav' => 'Main Menu',
//             'footer_nav' => 'Footer Menu',
//             'legal_nav' => 'Legal Menu'
//         )
//     );
// }
// add_action('init', 'cg_base_register_menus');

// add_theme_support('html5', array (
//     'comment-form',
//     'comment-list',
//     'gallery',
//     'caption'
// ));





// Potential trying to fix navs 
// https://www.youtube.com/watch?v=ptKG83zlWjI
// class StarterSite extends TimberSite {
//     public function __construct() {
//         add_action('after_setup_theme', array( $this, 'theme_supports'));
//         add_action('after_setup_theme', array( $this, 'register_menus'));
//         add_filter('timber/context', array( $this, 'add_to_context'));
//         add_filter('timber/twig', array( $this, 'add_to_twig'));
//         parent::__construct();
//     }

//     public function register_menus() {
//         register_nav_menus(
//             array(
//                 'top_nav' => 'Top Menu',
//                 'main_nav' => 'Main Menu',
//                 'footer_nav' => 'Footer Menu',
//                 'legal_nav' => 'Legal Menu'
//             )
//         );
//     }

//     public function add_to_context() {
//         $context['menu_header'] = new Timber\Menu('main_nav');
//         $context['menu_footer'] = new Timber\Menu('footer_nav');
//         $context['site'] = $this;
//         return $context;
//     }

//     public function theme_supports() {
//         add_theme_support('post-thumbnails');
//         add_theme_support('menus');
//     }
// }

// new StarterSite();

