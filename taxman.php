<?php

/*
Plugin Name: Taxman
Plugin URI: http://github.com/ryanve/taxman
Description: Extend existing taxonomies to other post types.
Version: 0.1.1
Author: Ryan Van Etten
Author URI: http://ryanve.com
License: MIT
*/

add_action('init', function() {
    # Core types include: post page attachment revision nav_menu_item
    # Consider: get_post_types, get_taxonomies, get_object_taxonomies
    $taxos = apply_filters('plugin:taxman:taxos', array('post_tag', 'category'));
    $types = apply_filters('plugin:taxman:types', array('page')); # applicable post types
    foreach (array_filter($types, 'post_type_exists') as $type)
        foreach ($taxos as $tax)
            taxonomy_exists($tax) and register_taxonomy_for_object_type($tax, $type);
}, 100); # Run after custom type/taxo registrations.
