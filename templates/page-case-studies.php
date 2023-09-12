<?php
/**
 * Template Name: Case Studies
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$ppp = get_option( 'posts_per_page' );

$context['terms'] = get_terms( array(
    'taxonomy' => 'case-study-category',
    'hide_empty' => true,
    'orderby' => 'name',
    'order'   => 'ASC',
    'exclude' => array( 1 ),
) );

$case_studies_page = $context['global']['page_case_studies'];
if( $case_studies_page ){
	$context['cs_all_news'] = get_permalink($case_studies_page);
} 

$case_studies_args = [
    'post_type' => 'case-study',
    'posts_per_page' => $ppp,
    'post_status' => 'publish',
    'paged' => $paged,
    'orderby' => 'date',
    'order'   => 'DESC',
];

if($paged != '1'){
    $context['paged'] = ' - '. __('Page ', 'cd-theme') . $paged;
}

$context['posts']= new Timber\PostQuery($case_studies_args);

require_once('components.php');

Timber::render( array( 'pages/page-case-studies.twig', 'page.twig' ), $context );
