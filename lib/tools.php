<?php

/*********************
TOOLS
*********************/

/**
 * ACF - Adds Theme Options to Wordpress Menu
 */
if(function_exists('acf_add_options_page')) {
    acf_add_options_page(
        [
            'page_title' => 'Site Options',
            'menu_title' => 'Site Options',
            'menu_slug' => 'site-options',
        ]
    );
}

/**
 * ACF - Hide current post from selection of related posts.
 */
function mw_acf_fields_relationship_query( $args, $field, $post_id ) {    
    $args['post__not_in'] = array($post_id);
    
    return $args;
}

add_filter('acf/fields/relationship/query', 'mw_acf_fields_relationship_query', 10, 3);

/**
 * Custom menu function
 */
function custom_menu($menu, $parent = false) {
    $wp_menu = wp_get_nav_menu_items($menu);
    $new_menu = [];

    if($wp_menu) {
        foreach($wp_menu as $wp_menu_item) {
            $object_id = $wp_menu_item->object_id;
            $type = $wp_menu_item->object; 
            $parent_item = $wp_menu_item->menu_item_parent;
            $dropdown_panel = get_field('dropdown_panel', $wp_menu_item);

            if($parent == true && $parent_item == 0){

                $new_menu[$wp_menu_item->ID] = [
                    'object_id' => $object_id,
                    'id' => $wp_menu_item->ID,
                    'name' => $wp_menu_item->title,
                    'url' => $wp_menu_item->url,
                    'target' => $wp_menu_item->target,
                    'attr_title'=> $wp_menu_item->attr_title,
                    'classes' => $wp_menu_item->classes,
                    'post_parent' => $wp_menu_item->post_parent,
                    'menu_item_parent' =>  $parent_item,
                    'type' => $type,
                    'description' => $wp_menu_item->description,
                    'panel' => $dropdown_panel
                ];

            } elseif($parent == false) {
                $new_menu[$wp_menu_item->ID] = [
                    'object_id' => $object_id,
                    'id' => $wp_menu_item->ID,
                    'name' => $wp_menu_item->title,
                    'url' => $wp_menu_item->url,
                    'target' => $wp_menu_item->target,
                    'attr_title'=> $wp_menu_item->attr_title,
                    'classes' => $wp_menu_item->classes,
                    'post_parent' => $wp_menu_item->post_parent,
                    'menu_item_parent' =>  $parent_item,
                    'type' => $type,
                    'description' => $wp_menu_item->description, 
                    'panel' => $dropdown_panel
                ];

                if($parent_item){
                    $new_menu[$parent_item]['child'] = true;
                }
            }
        }
    }

    return $new_menu;
}

/**
 * Pre function to allow easy to read data reading.
 */
function pre($array) {
	echo '<pre style="background-color: lightgrey; margin: 0 20px; padding: 0 20px;">';
	    print_r($array);
	echo '</pre>';
}

/**
 * Split array into selected number of chunks.
 */
function partition(Array $list, $p) {
    $listlen = count($list);
    $partlen = floor($listlen / $p);
    $partrem = $listlen % $p;
    $partition = array();
    $mark = 0;
    for($px = 0; $px < $p; $px ++) {
        $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
        $partition[$px] = array_slice($list, $mark, $incr);
        $mark += $incr;
    }
    return $partition;
}

/**
 * Get current URL
 */
function currentUrl( $trim_query_string = false ) {
    $pageURL = (isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on') ? "https://" : "http://";
    $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    if( ! $trim_query_string ) {
        return $pageURL;
    } else {
        $url = explode( '?', $pageURL );
        return $url[0];
    }
}

/**
 * Multidimensional array value lookup
 */
function in_array_r($needle, $haystack = [], $strict = false) { 
    if(!empty($haystack)){
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                return $item;
            }
        }
        return false;
    }
}