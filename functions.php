<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

// need to add all cats to main query due to default cat posts being excluded

add_action('pre_get_posts', 'reset_main_query');

function reset_main_query( $query ){
  
  // get all cats
  
  $terms = get_terms( array(
    'taxonomy'   => 'category',
  ) );

$termArr = [];

  foreach($terms as $term) { 
    // add cat ids to $termArr
     $termArr[] = $term->term_id;
}
 
  if (  !is_admin() && $query->is_main_query() ) {
    
  // use $termArr to set main_query so we don't have to hardcode the cat ids
  
   $query->set('cat', $termArr);
   return $query;
   
  }
}

// add forumpost content to main_query

function soma_include_custom_post_types_in_search_results( $query ) {
  if ( ($query->is_main_query() || $query->is_search()) && ! is_admin() ) {
      $query->set( 'post_type', array( 'post', 'forumpost' ) );
  }
}
add_action( 'pre_get_posts', 'soma_include_custom_post_types_in_search_results' );

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);


function blockhaus_load_blocks() {
	
  register_block_type( __DIR__ . '/blocks/taxonomy-list/block.json' );


}
add_action( 'init', 'blockhaus_load_blocks' );
?>