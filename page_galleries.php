<?php
/**
 * Template Name: Galleries
 *
 * The template for displaying galleries landing page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wells
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'galleries' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
