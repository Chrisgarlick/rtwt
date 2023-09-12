<?php 

use Timber\Timber;

Timber::$dirname = array('templates'); 

class TemplateBuild extends TimberSite {

	function __construct() {
		add_theme_support('post-thumbnails');
		add_theme_support('menus');
		add_theme_support('html5', ['search-form', 'gallery', 'caption']);
		add_theme_support('post-thumbnails');
		add_theme_support( 'yoast-seo-breadcrumbs' );
		add_image_size( 'large', 720, 720, true );
		register_nav_menus(
			[
				'main_nav' => 'Main Menu',
				'footer_nav' => 'Footer Menu',
				'legal_nav' => 'Legal Menu',
			]
		);

		add_filter('timber_context', [$this, 'add_to_context']);
		parent::__construct();
	}

	function add_to_context($context) {
		$global = get_field('global', 'options');
		$context['global'] = $global;

		$pageid = get_the_id();

		$context['current_user'] = get_current_user_id();
		$context['pageid'] = $pageid;
		$context['current_url'] = currentUrl();
		$context['site'] = $this;
		$context['permalink'] = get_the_permalink();
		$context['privacy_policy'] = get_privacy_policy_url();
		$context['all_news'] = get_permalink(get_option( 'page_for_posts', true));
		$context['logged_in'] = is_user_logged_in();
		
		// Set Yoaast breadcrumb
		if(function_exists('yoast_breadcrumb') && !is_front_page()) {
			$context['breadcrumb'] = yoast_breadcrumb('<p id="breadcrumbs">','</p>', false);
		}

		// Cookie acceptance
		$context['cookie_acceptance'] = '';
		if(isset($_COOKIE['cookie_acceptance'])) {
			$context['cookie_acceptance'] = $_COOKIE['cookie_acceptance'];
		}

		// Global menus
		$nav_locations = get_nav_menu_locations();		
		$navs = [];
		foreach($nav_locations as $navkey => $nav) {
			$navs[$navkey] = get_term($nav_locations[$navkey], 'nav_menu');
		}

		foreach($navs as $nmkey => $nm) {
			$context['menu_name'][$nmkey] = $nm->name;
			$context['menu'][$nmkey] = custom_menu($nm->name);
		}

		return $context;
	}
}

new TemplateBuild();