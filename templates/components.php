<?php 
// Include all logic for flexible components
if ( is_home() || is_category() || is_tax() ) {
    $page_id = get_option('page_for_posts', true);
    $context['page']['hero'] = get_field('flexible_hero', $page_id);
    $context['page']['content'] = get_field('flexible_components', $page_id);
    
    if(is_tax() || is_category()){
        $context['page']['hero'][0]['title'] = single_term_title( '', false );
        $context['page']['hero'][0]['introduction'] = category_description();
        $context['page']['hero'][0]['acf_fc_layout'] = 'small_hero';
        $context['page']['hero'][0]['space_bottom'] = true;
    }
} else {
    $context['page']['hero'] = get_field('flexible_hero');
    $context['page']['content'] = get_field('flexible_components');
    $context['page']['blogs_content'] = get_field('flexible_blogs');
    $context['page']['test_content'] = get_field('flexible_testimonials');
    $context['page']['res_content'] = get_field('flexible_resources');

}

if($context['page']['content']){

    for($i = 0; $i < count($context['page']['content']); $i++) {
        $context['page']['content'][$i]['order'] = $i + 1;

        if($context['page']['content'][$i]['acf_fc_layout'] == 'global_component') {
            $component_id = $context['page']['content'][$i]['component'];
            $components = get_field('flexible_components', $component_id );
            unset($context['page']['content'][$i]);
            array_splice( $context['page']['content'], $i, 0, $components );
        }
        // Component Made
        if($context['page']['content'][$i]['acf_fc_layout'] == 'related_news_component') {
            $related_ids = $context['page']['content'][$i]['related_ids'];            
            $category = $context['page']['content'][$i]['category']; 
            $option = $context['page']['content'][$i]['select_news']; 

            $context['all_news'] = get_permalink(get_option( 'page_for_posts', true));
            if( $case_studies_page ){
                $context['cs_all_news'] = get_permalink($case_studies_page);
            } 

            $related_news_args = [
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post_status' => 'publish', 
            ];

            if($related_ids && $option == 'manual'){
                $category = false;
                $related_news_args['orderby'] = 'post__in';
                $related_news_args['posts_per_page'] = -1;
                $related_news_args['post__in'] = $related_ids;
            }

            if($category && $option == 'category'){
                $related_news_args['tax_query'][] = [
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $category
                ];
            }

            $context['page']['content'][$i]['posts'] = new Timber\PostQuery($related_news_args);
            $context['page']['content'][$i]['light'] = true;
        }
        
        if($context['page']['content'][$i]['acf_fc_layout'] == 'resources_component') {
            $member_ids = $context['page']['content'][$i]['resources'];            
          

            $work_args = [
                'post_type' => 'resources',
                'posts_per_page' => 3,
                'post_status' => 'publish', 
                'orderby' => 'post__in',
                'post__in' => $member_ids
            ];

            $context['page']['content'][$i]['posts'] = new Timber\PostQuery($work_args);
        }

        // Related Case Studies Component
        if($context['page']['content'][$i]['acf_fc_layout'] == 'related_resources_component') {
            $related_ids = $context['page']['content'][$i]['related_ids'];            
            $category = $context['page']['content'][$i]['category']; 
            $option = $context['page']['content'][$i]['select_resource']; 

            // $case_studies_page = $context['global']['page_case_studies'];
            // if( $case_studies_page ){
            //     $context['cs_all_news'] = get_permalink($case_studies_page);
            // } 

            $related_news_args = [
                'post_type' => 'resources',
                'posts_per_page' => 3,
                'post_status' => 'publish', 
            ];

            if($option == 'manual'){
                $category = false;
                $related_news_args['orderby'] = 'post__in';
                $related_news_args['posts_per_page'] = -1;
                $related_news_args['post__in'] = $related_ids;
            }

            if($option == 'category'){
                $related_news_args['tax_query'][] = [
                    'taxonomy' => 'subject',
                    'field'    => 'term_id',
                    'terms'    => $category
                ];
            }

            $context['page']['content'][$i]['posts'] = new Timber\PostQuery($related_news_args);
        }

        // Related Testimonials Component
        if($context['page']['content'][$i]['acf_fc_layout'] == 'related_testimonials_component') {
            $related_ids = $context['page']['content'][$i]['related_ids'];            
            $category = $context['page']['content'][$i]['category']; 
            $option = $context['page']['content'][$i]['select_testimonial']; 

            $related_test_args = [
                'post_type' => 'testimonials',
                'posts_per_page' => 3,
                'post_status' => 'publish', 
            ];

            if($related_ids && $option == 'manual'){
                $category = false;
                $related_test_args['orderby'] = 'post__in';
                $related_test_args['posts_per_page'] = -1;
                $related_test_args['post__in'] = $related_ids;
            }

            if($category && $option == 'category'){
                $related_test_args['tax_query'][] = [
                    'taxonomy' => 'type',
                    'field'    => 'term_id',
                    'terms'    => $category
                ];
            }
            $context['page']['content'][$i]['posts'] = new Timber\PostQuery($related_test_args);

        }

        if($context['page']['content'][$i]['acf_fc_layout'] == 'faq_component') {

            $faq_args = [
                'post_type' => 'faq',
                'posts_per_page' => 5,
                'post_status' => 'publish'
            ]; 
            
            $context['page']['content'][$i]['faq_posts'] = new Timber\PostQuery($faq_args);
        }
    }
}


