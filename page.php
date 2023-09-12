<?php
/**
 * The template for displaying all pages.
 */

$context = Timber::context();
$timber_post = Timber::query_post();
$context['post'] = $timber_post;

 if ( post_password_required( $timber_post->ID ) ) {
	Timber::render( 'single/single-password.twig', $context );
 } else {
     require_once('templates/components.php');

    //  $images = get_field('image_repeater', $timber_post->ID);
    // $context->images = $images;


    Timber::render( 'page.twig', $context );
}