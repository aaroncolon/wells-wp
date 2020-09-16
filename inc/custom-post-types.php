<?php
function wells_register_cpt() {
  // Galleries
  $wells_galleries_labels = array(
    'name'               => _x( 'Galleries', 'post type general name', 'wells-textdomain' ),
    'singular_name'      => _x( 'Gallery', 'post type singular name', 'wells-textdomain' ),
    'menu_name'          => _x( 'Galleries', 'admin menu', 'wells-textdomain' ),
    'name_admin_bar'     => _x( 'Gallery', 'add new on admin bar', 'wells-textdomain' ),
    'add_new'            => _x( 'Add New', 'Gallery', 'wells-textdomain' ),
    'add_new_item'       => __( 'Add New Gallery', 'wells-textdomain' ),
    'new_item'           => __( 'New Gallery', 'wells-textdomain' ),
    'edit_item'          => __( 'Edit Gallery', 'wells-textdomain' ),
    'view_item'          => __( 'View Gallery', 'wells-textdomain' ),
    'all_items'          => __( 'All Galleries', 'wells-textdomain' ),
    'search_items'       => __( 'Search Galleries', 'wells-textdomain' ),
    'parent_item_colon'  => __( 'Parent Galleries:', 'wells-textdomain' ),
    'not_found'          => __( 'No Galleries found.', 'wells-textdomain' ),
    'not_found_in_trash' => __( 'No Galleries found in Trash.', 'wells-textdomain' )
  );

  register_post_type('wells_galleries', array(
    'labels'              => $wells_galleries_labels,
    'description'         => '',
    'has_archive'         => false,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'menu_position'       => 7,
    'capability_type'     => 'post',
    'map_meta_cap'        => true,
    'hierarchical'        => false,
    'rewrite'             => array('slug' => 'galleries', 'with_front' => false),
    'query_var'           => true,
    'supports'            => array('title','editor','thumbnail'),
    'show_in_rest'        => true,
  ));
}
add_action( 'init', 'wells_register_cpt' );

// function wells_register_series_taxonomy() {
//   $labels = array(
//     'name' => 'Series',
//     'singular_name' => 'Series',
//     'search_items' =>  'Search Series',
//     'all_items' => 'All Series',
//     'edit_item' => 'Edit Series',
//     'update_item' => 'Update Series',
//     'add_new_item' => 'Add New Series',
//     'new_item_name' => 'New Series Name'
//   );
//
//   $args = array(
//     'hierarchical' => true,
//     'labels' => $labels,
//     'show_ui' => true,
//     'show_admin_column' => true
//   );
//
//   register_taxonomy( 'wells_series', array('wells_photos_galleries'), $args );
// }
// add_action('init', 'wells_register_series_taxonomy');
