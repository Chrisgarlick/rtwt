<?php
/**
 * Template Name: FAQs
 */

$context = Timber::get_context();
$timber_post = Timber::query_post();
$context['post'] = $timber_post;

$faqs_args = [
    'post_type' => 'faq',
    'posts_per_page' => -1,
    'post_status' => 'publish'
]; 

$faqs = new Timber\PostQuery($faqs_args);
$groups = [];
$no_group = [];

foreach ($faqs as $faq) {
   $terms =  get_the_terms($faq, 'faq-category' );
   if($terms[0]){
    $groups[$terms[0]->term_id]['name'] = $terms[0]->name;
    $groups[$terms[0]->term_id]['term_id'] = $terms[0]->term_id;
    $groups[$terms[0]->term_id]['posts'][] = $faq;
   } else {
    $no_group[0]['posts'][] = $faq;
    $no_group[0]['term_id'] = 0;
   }
} 
wp_reset_postdata();

$context['groups'] = array_merge($no_group, $groups);

require_once('components.php');

Timber::render( array( 'pages/page-faqs.twig', 'page.twig' ), $context );