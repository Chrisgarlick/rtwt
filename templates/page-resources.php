<?php
/**
 * Template Name: Resources
 */

$context = Timber::get_context();
$ppp = get_option( 'posts_per_page' );

$posts_args = [
    'post_type' => 'resources',
    'posts_per_page' => $ppp,
    'post_status' => 'publish'
];

$context['posts'] = new Timber\PostQuery($posts_args);
$context['ppp'] = $ppp;

$context['terms'] = get_terms( array(
    'taxonomy' => 'subject',
    'hide_empty' => true,
    'orderby' => 'name',
    'order'   => 'DESC',
) );

require_once('components.php');

Timber::render( array( 'pages/page-resources.twig', 'page.twig' ), $context );