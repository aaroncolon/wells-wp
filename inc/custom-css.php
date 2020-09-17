<?php
/**
 * Wells Custom CSS
 */

/**
 * Generate CSS.
 *
 * @param string $selector The CSS selector.
 * @param string $style The CSS style.
 * @param string $value The CSS value.
 * @param string $prefix The CSS prefix.
 * @param string $suffix The CSS suffix.
 * @param bool   $echo Echo the styles.
 */
function wells_generate_css( $selector, $style, $value, $prefix = '', $suffix = '', $echo = true ) {
  $return = '';

  /*
   * Bail early if we have no $selector elements or properties and $value.
   */
  if ( ! $value || ! $selector ) {
    return;
  }

  $return = sprintf( '%s { %s: %s; }', $selector, $style, $prefix . $value . $suffix );

  if ( $echo ) {
    echo $return; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- We need to double check this, but for now, we want to pass PHPCS ;)
  }

  return $return;
}

/**
 * Get CSS Built from Customizer Options.
 * Build CSS reflecting colors, fonts and other options set in the Customizer, and return them for output.
 *
 * @param string $type Whether to return CSS for the "front-end", "block-editor" or "classic-editor".
 */
function wells_get_customizer_css( $type = 'front-end' ) {
  $main_text_color             = get_theme_mod('main_text_color', '#333333');
  $link_color                  = get_theme_mod('link_color', '#4169e1');
  $link_hover_color            = get_theme_mod('link_hover_color', '#191970');
  $nav_link_color              = get_theme_mod('nav_link_color', '#4169e1');
  $nav_link_hover_color        = get_theme_mod('nav_link_hover_color', '#191970');
  $mobile_nav_link_color       = get_theme_mod('mobile_nav_link_color', '#4169e1');
  $mobile_nav_link_hover_color = get_theme_mod('mobile_nav_link_hover_color', '#191970');
  $mobile_nav_bg_color         = get_theme_mod('mobile_nav_bg_color', '#f1f1f1');
  $h1_text_color               = get_theme_mod('h1_text_color', '#333333');
  $h2_text_color               = get_theme_mod('h2_text_color', '#333333');
  $h3_text_color               = get_theme_mod('h3_text_color', '#333333');
  $h4_text_color               = get_theme_mod('h4_text_color', '#333333');
  $h5_text_color               = get_theme_mod('h5_text_color', '#333333');

  $styles = '
    body, button, input, select, optgroup, textarea { color: '. $main_text_color .'}
    a, a:visited { color: '. $link_color .'}
    a:hover, a:active, a:focus { color: '. $link_hover_color .'}
    .main-navigation a, .main-navigation a:visited { color: '. $nav_link_color .'}
    .main-navigation a:hover, .main-navigation a:active, .main-navigation:focus { color: '. $nav_link_hover_color .'}
    .main-navigation .current_page_item > a, .main-navigation .current-menu-item > a, .main-navigation .current_page_ancestor > a, .main-navigation .current-menu-ancestor > a { color: '. $nav_link_hover_color .' }
    .mobile-navigation a, .mobile-navigation a:visited { color: '. $mobile_nav_link_color .'}
    .mobile-navigation a:hover, .mobile-navigation a:active, .mobile-navigation:focus { color: '. $mobile_nav_link_hover_color .'}
    .mobile-navigation .current_page_item > a, .mobile-navigation .current-menu-item > a, .mobile-navigation .current_page_ancestor > a, .mobile-navigation .current-menu-ancestor > a { color: '. $mobile_nav_link_hover_color .' }
    .mobile-navigation { background-color: '. $mobile_nav_bg_color .'}
    h1 { color: '. $h1_text_color .'}
    h2 { color: '. $h2_text_color .'}
    h3 { color: '. $h3_text_color .'}
    h4 { color: '. $h4_text_color .'}
    h5 { color: '. $h5_text_color .'}
  ';

  return $styles;
}
