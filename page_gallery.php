<?php
/**
 * Template Name: Gallery
 *
 * The template for displaying a gallery on a page
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

			get_template_part( 'template-parts/content', 'gallery' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
