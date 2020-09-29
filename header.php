<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wells
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'wells' ); ?></a>

	<nav id="site-navigation-mobile" class="mobile-navigation">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'mobile-menu',
				'menu_id'        => 'mobile-menu',
			)
		);
		?>
	</nav>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$wells_description = get_bloginfo( 'description', 'display' );
			if ( $wells_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $wells_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<button id="menu-toggle-mobile" class="menu-toggle" aria-controls="mobile-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'wells' ); ?></button>

		<nav id="site-navigation" class="main-navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary-menu',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'menu menu--primary'
				)
			);

			wp_nav_menu(
				array(
					'theme_location' => 'secondary-menu',
					'menu_id'        => 'secondary-menu',
					'menu_class'     => 'menu menu--secondary'
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
