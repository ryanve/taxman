<?php
/*
Plugin Name: Taxman
Plugin URI: http://github.com/ryanve/taxman
Description: Extend existing taxonomies to other post types.
Version: 0.1.2
Author: Ryan Van Etten
Author URI: http://ryanve.com
License: MIT
*/

add_action('init', function() {
    # Core types include: post page attachment revision nav_menu_item
    # Consider: get_post_types, get_taxonomies, get_object_taxonomies
    $types = apply_filters('plugin:taxman:types', array('page'));
    $taxos = apply_filters('plugin:taxman:taxos', array('post_tag', 'category'));
    if ( ! $types || ! $taxos)
        return;
    # Do redundant checks to be safe.
    $types = array_filter($types, 'post_type_exists');
    $taxos = array_filter($taxos, 'taxonomy_exists');
    foreach ($types as $type)
        foreach ($taxos as $tax)
            register_taxonomy_for_object_type($tax, $type);
}, 100); # Run after custom type/taxo registrations.
