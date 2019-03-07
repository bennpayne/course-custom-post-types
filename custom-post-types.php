<?php
/**
 * Plugin Name: Custom Post Types and Taxonomies
 * Plugin URI:  https://hereismy.com/plugins/
 * Description: Custom Post Types and Taxonomies Plugin
 * Version:     1.0.0
 * Author:      Benn Payne
 * Author URI:  https://hereismy.com
 * Text Domain: pretty-portfolio
 * Domain Path: /languages
 * License:     GPL2
 * 
 * Copyright 2019 BH Payne
 * Custom Post Types and Taxonomies is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *  
 * Custom Post Types and Taxonomies is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *  
 * You should have received a copy of the GNU General Public License
 * along with Custom Post Types and Taxonomies. If not, see https://hereismy.com/wp-posttypes-and-taxonomies/.
 */

 // Exit if accessed directly.
 if( !defined( 'ABSPATH' ) ) exit;


// Bare minimum for a plugin to be activated
// function my_custom_posttypes() {
//     $args = array(
//       'public' => true,
//       'label'  => 'Testimonials'
//     );
//     register_post_type( 'testimonial', $args );
// }
// add_action( 'init', 'my_custom_posttypes' );

/**
 * Register a custom post type called "Testimonials".
 */

function my_custom_posttypes() {
    // testimonials posttype
    $labels = array(
        'name'               => 'Testimonials',
        'singular_name'      => 'Testimonial',
        'menu_name'          => 'Testimonials',
        'name_admin_bar'     => 'Testimonial',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Testimonial',
        'new_item'           => 'New Testimonial',
        'edit_item'          => 'Edit Testimonial',
        'view_item'          => 'View Testimonial',
        'all_items'          => 'All Testimonials',
        'search_items'       => 'Search Testimonials',
        'parent_item_colon'  => 'Parent Testimonials:',
        'not_found'          => 'No testimonials found.',
        'not_found_in_trash' => 'No testimonials found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-id-alt',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonials' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
		'show_in_rest'		 => true
    );

    register_post_type( 'testimonial', $args );

    // review posttype
    $labels = array(
        'name'               => 'Reviews',
        'singular_name'      => 'Review',
        'menu_name'          => 'Reviews',
        'name_admin_bar'     => 'Review',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Review',
        'new_item'           => 'New Review',
        'edit_item'          => 'Edit Review',
        'view_item'          => 'View Review',
        'all_items'          => 'All Reviews',
        'search_items'       => 'Search Reviews',
        'parent_item_colon'  => 'Parent Reviews:',
        'not_found'          => 'No reviews found.',
        'not_found_in_trash' => 'No reviews found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'reviews' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-star-half',
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'taxonomies'         => array( 'category', 'post_tag' ),
		'show_in_rest'		 => true
    );
    register_post_type( 'review', $args );
}



add_action( 'init', 'my_custom_posttypes' );

// Flush rewrite rules to add "review" as a permalink slug
function my_rewrite_flush() {
    my_custom_posttypes();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );


/**
 * Create and Register Custom Taxonomies.
 */
function my_custom_taxonomies() {
    
    /* Type of Product/Service Taxonomy */
    $labels = array(
        'name'              => 'Type of Products/Services',
        'singular_name'     => 'Type of Product/Service',
        'search_items'      => 'Search Types of Products/Services',
        'all_items'         => 'All Types of Products/Services',
        'parent_item'       => 'Parent Type of Product/Service',
        'parent_item_colon' => 'Parent Type of Product/Service:',
        'edit_item'         => 'Edit Type of Product/Service',
        'update_item'       => 'Update Type of Product/Service',
        'add_new_item'      => 'Add New Type of Product/Service',
        'new_item_name'     => 'New Type of Product/Service Name',
        'menu_name'         => 'Type of Product/Service',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'product-types' ),
        'show_in_rest'		=> true
    );

    register_taxonomy( 'product-type', array( 'review' ), $args );
    
    // /* Price Range */
    // register_taxonomy(
	// 	'Price Range',
	// 	'review',
	// 	array(
	// 		'label' => __( 'Price Range' ),
	// 		'rewrite' => array( 'slug' => 'price' ),
	// 		'hierarchical' => true,
	// 	)
	// );

    /* Price Range Taxonomy */
    $labels = array(
        'name'              => 'Price Ranges',
        'singular_name'     => 'Price Range',
        'search_items'      => 'Search Price Ranges',
        'all_items'         => 'All Price Ranges',
        'parent_item'       => 'Parent Price Range',
        'parent_item_colon' => 'Parent Price Range:',
        'edit_item'         => 'Edit Price Range',
        'update_item'       => 'Update Price Range',
        'add_new_item'      => 'Add New Price Range',
        'new_item_name'     => 'New Price Range Name',
        'menu_name'         => 'Price Range',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'prices' ),
        'show_in_rest'		=> true
    );

    register_taxonomy( 'price', array( 'review' ), $args );

    /* Mood Taxonomy */
    $labels = array(
        'name'                       => 'Moods',
        'singular_name'              => 'Mood',
        'search_items'               => 'Search Moods',
        'popular_items'              => 'Popular Moods',
        'all_items'                  => 'All Moods',
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => 'Edit Mood',
        'update_item'                => 'Update Mood',
        'add_new_item'               => 'Add New Mood',
        'new_item_name'              => 'New Mood Name',
        'separate_items_with_commas' => 'Separate moods with commas',
        'add_or_remove_items'        => 'Add or remove moods',
        'choose_from_most_used'      => 'Choose from the most used moods',
        'not_found'                  => 'No moods found.',
        'menu_name'                  => 'Moods',
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'moods' ),
    );

    register_taxonomy( 'mood', array( 'review', 'post' ), $args );
}

add_action( 'init', 'my_custom_taxonomies' );





















