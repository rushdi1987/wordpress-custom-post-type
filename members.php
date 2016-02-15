<?php 
/*
Plugin Name: Team members
Plugin URI: 
Description: This plugin lets you add team members.
Author: Rushdi
Version: 1.0
Author URI: http://www.github.com/rushdi1987/
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// include the custom post type class
include_once('class-post-type.php');
// create a member custom post type
$members = new CPT('member', array(
    'supports' => array('title', 'excerpt', 'thumbnail')
));
// create a department taxonomy
$members->register_taxonomy('department');

// define the columns to appear on the admin edit screen
$members->columns(array(
    'cb' => '<input type="checkbox" />',
    'title' => __('Title'),
    'department' => __('Departments'),
    'price' => __('Price'),
    'rating' => __('Rating'),
    'date' => __('Date'),
    'age' => __('Age'),
    'location' => __('Location')

));
// populate the price column
$members->populate_column('price', function($column, $post) {
    echo "£" . get_field('price'); // ACF get_field() function
}); 
// populate the ratings column
$members->populate_column('rating', function($column, $post) {
    echo get_field('rating') . '/5'; // ACF get_field() function
});
// populate the ratings column
$members->populate_column('location', function($column, $post) {
    echo get_post_field( 'location', $post->ID ) . ', Bangladesh'; // ACF get_field() function
});
// make rating and price columns sortable
$members->sortable(array(
    'price' => array('price', true),
    'rating' => array('rating', true),
    'location' => array('location', true)
));
// use "pages" icon for post type
$members->menu_icon("slide.png");

$members-> add_tm_custom_post_metaboxes('Location');



?>