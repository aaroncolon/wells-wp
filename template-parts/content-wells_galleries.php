<?php
/**
 * Template part for displaying page content in single-wells_galleries.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wells
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		$images = get_field('wells_images');
		?>
		<script>
		 	const wells_images = <?php echo json_encode($images) ?>;
		</script>

		<div class="gallery-mobile">
			<?php
			foreach ($images as $image) :
				$desc = ($image['description'])
								? $image['description']
								: (($image['caption']) ? $image['caption'] : $image['title']);
			?>
				<div class="gallery-mobile__slide">
					<div class="gallery-mobile__slide-image">
						<?php echo wp_get_attachment_image($image['id'], 'lg', false, array('sizes' => '100vw')); ?>
					</div>
					<p class="gallery-mobile__slide-description">
						<?php esc_html_e($desc) ?>
					</p>
				</div>
			<?php
			endforeach;
			?>
		</div>

		<div class="royalSlider-container">
			<div class="royalSlider rsUni">
				<?php
				foreach ($images as $image) :
				?>
					<a
						class="rsImg"
						href="<?php echo esc_url($image['sizes']['xl']) ?>"
						data-id="<?php esc_attr_e($image['id']) ?>"
						data-title="<?php esc_attr_e($image['title']) ?>"
						data-alt="<?php esc_attr_e($image['alt']) ?>"
						data-description="<?php esc_attr_e($image['description']) ?>"
						data-caption="<?php esc_attr_e($image['caption']) ?>">
							<?php esc_attr_e($image['name']) ?>
					</a>
				<?php
				endforeach;
				?>
			</div>

			<div class="rs-meta">
				<div class="rs-controls">
					<button class="rs-controls__button rs-controls__prev">Prev</button> /
					<button class="rs-controls__button rs-controls__next">Next</button>
				</div>
			</div>
		</div>

		<?php
		the_content();
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
