<?php

/**
 * Adds Filters Automatically from Array Keys
 */
add_action('genesis_meta', 'gb_add_array_filters_genesis_attr');
function gb_add_array_filters_genesis_attr()
{
    $filters = gb_merge_genesis_attr_classes();
    foreach(array_keys($filters) as $context) {
        $context = "genesis_attr_$context";
        add_filter($context, 'gb_add_markup_sanitize_classes', 10, 2);
    }
}

/**
 * Clean classes output
 */
function gb_add_markup_sanitize_classes($attr, $context)
{
    $classes = array();
    if (has_filter('gb_clean_classes_output')) {
        $classes = apply_filters('gb_clean_classes_output', $classes, $context, $attr);
    }
    $value = isset($classes[$context]) ? $classes[$context] : array();
    if (is_array($value)) {
        $classes_array = $value;
    }
    else {
        $classes_array = explode(' ', (string)$value);
    }
    $classes_array = array_map('sanitize_html_class', $classes_array);
    $attr['class'].= ' ' . implode(' ', $classes_array);
    return $attr;
}

/**
 * Default array of classes to add
 */
function gb_merge_genesis_attr_classes()
{
    $classes = array(
        'structural-wrap' => 'container',
      'content-sidebar-wrap' => 'container'
    );

    if (has_filter('gb_add_classes')) {
        $classes = apply_filters('gb_add_classes', $classes);
    }
    
    return $classes;
}


/**
 * Adds classes array to bsg_add_markup_class() for cleaning
 */
add_filter('gb_clean_classes_output', 'gb_modify_classes_based_on_extras', 10, 3);
function gb_modify_classes_based_on_extras($classes, $context, $attr)
{
    $classes = gb_merge_genesis_attr_classes($classes);
    return $classes;
}