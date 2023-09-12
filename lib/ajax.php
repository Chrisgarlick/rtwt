<?php

add_action('wp_ajax_ajax_team_filter', 'ajax_team_filter');
add_action('wp_ajax_nopriv_ajax_team_filter', 'ajax_team_filter');

function ajax_resource_filter() {
    $context = Timber::context();
    $post = new TimberPost();
    $context['post'] = $post;
    $ppp = get_option( 'posts_per_page' );

	$term_id = $_POST['term_id'];
    $paged = isset($_POST['paged']) ? $_POST['paged'] : 1;
    
	ob_start();

    $posts_args = [
        'post_type' => 'resource',
        'posts_per_page' => $ppp,
        'post_status' => 'publish',
        'paged' => (int)$paged,
    ]; 

    if($term_id){
        $posts_args['tax_query'][] = [
            'taxonomy' => 'subject',
            'field'    => 'term_id',
            'terms'    => $term_id
        ];
    }

    $posts = new Timber\PostQuery($posts_args);

    $context['posts'] = $posts; 

    Timber::render( array( 'partials/resource-results.twig' ), $context );

	$html = ob_get_clean();

	$response = [
		'success' => true,
        'html' => $html,
        'total' => $posts->found_posts
    ];
    
    print json_encode($response);
    
	exit();
}


add_action('wp_ajax_ajax_news_filter', 'ajax_news_filter');
add_action('wp_ajax_nopriv_ajax_news_filter', 'ajax_news_filter');

function ajax_news_filter() {
    $context = Timber::context();
    $post = new TimberPost();
    $context['post'] = $post;
    $ppp = get_option( 'posts_per_page' );

	$term_id = $_POST['term_id'];
    $paged = isset($_POST['paged']) ? $_POST['paged'] : 1;
    
	ob_start();

    $posts_args = [
        'post_type' => 'post',
        'posts_per_page' => $ppp,
        'post_status' => 'publish',
        'paged' => (int)$paged,
    ]; 

    if($term_id){
        $posts_args['tax_query'][] = [
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $term_id
        ];
    }

    $posts = new Timber\PostQuery($posts_args);

    $context['posts'] = $posts; 

    Timber::render( array( 'partials/news-results.twig' ), $context );

	$html = ob_get_clean();

	$response = [
		'success' => true,
        'html' => $html,
        'total' => $posts->found_posts
    ];
    
    print json_encode($response);
    
	exit();
}

add_action('wp_ajax_ajax_cs_filter', 'ajax_cs_filter');
add_action('wp_ajax_nopriv_ajax_cs_filter', 'ajax_cs_filter');

function ajax_cs_filter() {
    $context = Timber::context();
    $post = new TimberPost();
    $context['post'] = $post;
    $ppp = get_option( 'posts_per_page' );

	$term_id = $_POST['term_id'];
    $paged = isset($_POST['paged']) ? $_POST['paged'] : 1;
    
	ob_start();

    $posts_args = [
        'post_type' => 'case-study',
        'posts_per_page' => $ppp,
        'post_status' => 'publish',
        'paged' => (int)$paged,
    ]; 

    if($term_id){
        $posts_args['tax_query'][] = [
            'taxonomy' => 'case-study-category',
            'field'    => 'term_id',
            'terms'    => $term_id
        ];
    }

    $posts = new Timber\PostQuery($posts_args);

    $context['posts'] = $posts; 

    Timber::render( array( 'partials/news-results.twig' ), $context );
    
	$html = ob_get_clean();

	$response = [
		'success' => true,
        'html' => $html,
        'total' => $posts->found_posts
    ];
    
    print json_encode($response);
    
	exit();
}