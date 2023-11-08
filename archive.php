<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 */

$templates = array( 'archive.twig', 'index.twig' );
$context = Timber::context();

$queried_object = get_queried_object();
$context['active_filter'] = $queried_object->term_id;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 

if($paged != '1'){
    $context['paged'] = ' - '. __('Page ', 'cd-theme') . $paged;
}

// $case_studies_page = $context['global']['page_case_studies'];
// if( is_tax('case-study-category') && $case_studies_page ){
// 	$context['all_news'] = get_permalink($case_studies_page);
// } 

$context['terms'] = get_terms( array(
    'taxonomy' => $queried_object->taxonomy,
    'hide_empty' => true,
    'orderby' => 'name',
    'order'   => 'ASC',
    'exclude' => array( 1 ),
) );

if ( is_day() ) {
	$context['post']['title'] = __('Archive: ', 'cd-theme') . get_the_date( 'D M Y' );
} else if ( is_month() ) {
	$context['post']['title'] = __('Archive: ', 'cd-theme') . get_the_date( 'M Y' );
} else if ( is_year() ) {
	$context['post']['title'] = __('Archive: ', 'cd-theme') . get_the_date( 'Y' );
} else if ( is_tag() ) {
	$context['post']['title'] = single_tag_title( '', false );
} else if ( is_category() ) {
	$context['post']['title'] = single_cat_title( '', false );
	array_unshift( $templates, 'partials/archive-' . get_query_var( 'cat' ) . '.twig' );
} else if ( is_post_type_archive() ) {
	$context['post']['title'] = post_type_archive_title( '', false );
	array_unshift( $templates, 'partials/archive-' . get_post_type() . '.twig' );
} else {
	array_unshift( $templates, 'partials/archive-' . $queried_object->taxonomy . '.twig' );
	$context['post']['title'] = single_term_title( '', false );
}

$context['posts'] = new Timber\PostQuery();

require_once('templates/components.php');

Timber::render( $templates, $context );