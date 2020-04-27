<?php
add_action('genesis_meta', function(){
  add_filter('gb_add_classes', 'gb_custom_example');
});

function gb_custom_example($classes) {
  $new_classes = array( 
      'structural-wrap' => 'container',
      'content-sidebar-wrap' => 'container'
  );
  return wp_parse_args($new_classes, $classes);
}

/**
 * Add classes based on Site Layout
 */
add_filter('gb_clean_classes_output', 'gb_modify_classes_based_on_template', 11, 3);
function gb_modify_classes_based_on_template( $classes, $context, $attr ) {
    $classes = gb_layout_options_modify_classes_to_add( $classes );
    return $classes;
}

function gb_layout_options_modify_classes_to_add($classes) {
    $layout = genesis_site_layout();
    // full-width-content
    if ( 'full-width-content' === $layout ) {
    }
    // sidebar-content
    if ( 'sidebar-content' === $layout ) {
    }
    // content-sidebar-sidebar
    if ( 'content-sidebar-sidebar' === $layout ) {
    }
    // sidebar-sidebar-content
    if ( 'sidebar-sidebar-content' === $layout ) {
    }
    // sidebar-content-sidebar
    if ( 'sidebar-content-sidebar' === $layout ) {
    }
    return $classes;
}


/* Move sidebar wrap */
remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_get_sidebar_alt' );
add_action(    'genesis_after_content', 'genesis_get_sidebar_alt' );