<?php
/**
 * The Template for displaying all single posts
 */

$context = Timber::context();
$timber_post = Timber::query_post();
$context['post'] = $timber_post;

if ( post_password_required( $timber_post->ID ) ) {
	Timber::render( 'single/single-password.twig', $context );
} else {
	if($post->post_type == 'post'){
		$featured_image_id = get_post_thumbnail_id();
		if($featured_image_id ){
			$context['hero']['image'] = acf_get_attachment($featured_image_id);
		}
		$context['hero']['space_bottom'] = true;
	}

	$context['blogposts'] = Timber::get_posts(array('post_type' => 'post', 'posts_per_page' => -1, 'post_status' => 'publish'));

	$loopIndex = 0;
	foreach($context['blogposts'] as $blog) {
		if ($blog->ID == $post->ID) {
			$previousBlog = NULL;
			$nextBlog = NULL;
			if (isset($context['blogposts'][$loopIndex - 1])) {
				$previousBlog = $context['blogposts'][$loopIndex - 1];
			}
			if (isset($context['blogposts'][$loopIndex + 1])) {
				$nextBlog = $context['blogposts'][$loopIndex + 1];	
			}
			if ($previousBlog != NULL) {
				$context['previous_blog'] = $previousBlog;
			}
			if ($nextBlog != NULL) {
				$context['next_blog'] = $nextBlog;
			}
		}
		$loopIndex += 1;
	}
	
    require_once('templates/components.php');
	Timber::render( array( 'single/single-' . $post->ID . '.twig', 'single/single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}