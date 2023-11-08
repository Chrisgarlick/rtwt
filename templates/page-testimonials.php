<?php
/**
 * Template Name: Testimonials
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$ppp = get_option( 'posts_per_page' );

$context['terms'] = get_terms( array(
    'taxonomy' => 'type',
    'hide_empty' => true,
    'orderby' => 'name',
    'order'   => 'ASC',
    'exclude' => array( 1 ),
) );

$testimonial_page = $context['global']['page_testimonials'];
if( $testimonial_page ){
	$context['cs_all_news'] = get_permalink($testimonial_page);
} 

$testimonials = [
    'post_type' => 'testimonials',
    'posts_per_page' => $ppp,
    'post_status' => 'publish',
    'paged' => $paged,
    'orderby' => 'date',
    'order'   => 'DESC',
];

if($paged != '1'){
    $context['paged'] = ' - '. __('Page ', 'cg-theme') . $paged;
}

$context['posts'] = new Timber\PostQuery($testimonials);

require_once('components.php');

Timber::render( array( 'pages/page-testimonials.twig', 'page.twig' ), $context );
