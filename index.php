<?php 
/*
    Main Template File
*/

$context = Timber::get_context();
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 
$context['posts'] = new Timber\PostQuery();

$title = get_the_title( get_option('page_for_posts', true) );

if($paged != '1'){
    $context['paged'] = ' - '. __('Page ', 'cg-theme') . $paged;
}

$context['terms'] = get_terms( array(
    'taxonomy' => 'category',
    'hide_empty' => true,
    'orderby' => 'name',
    'order'   => 'ASC',
    'exclude' => array( 1 ),
) );

require_once('templates/components.php');

Timber::render( array( 'index.twig') , $context );