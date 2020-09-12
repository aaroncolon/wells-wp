<?php

/**
 * Advanced Custom Fields
 *
 * Dynamically Populate Select Field with Custom Post Types
 */
function wells_acf_load_gallery_choices($field) {
  // reset choices
  $field['choices'] = array();
  $field['choices'][''] = 'Select Gallery...';

  $args = array(
      'post_type'      => array('wells_galleries'),
      'posts_per_page' => -1,
      'orderby'        => 'title',
      'order'          => 'ASC',
      'fields'         => 'ids'
  );
  $q = new WP_Query($args);

  if ($q->have_posts()) {
    while ($q->have_posts()) {
      $q->the_post();
      $field['choices'][get_the_ID()] = esc_html(get_the_title());
    }
    wp_reset_postdata();
  }

  return $field;
}
add_filter('acf/load_field/name=wells_gallery', 'wells_acf_load_gallery_choices');
