<?php
/**
 * Template part for displaying page content in page_gallery.php
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
		$gallery_id = get_field('wells_gallery');
		$images = get_field('wells_images', $gallery_id);
		?>
		<script>
		 	const wells_images = <?php echo json_encode($images) ?>;
		</script>

		<div class="gallery-mobile">
			<?php
			foreach ($images as $image) :
				echo wp_get_attachment_image($image['id'], 'lg', false, array('sizes' => '100vw'));
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
						href="<?php echo esc_url($image['sizes']['lg']) ?>"
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
					<button class="rs-controls__prev rs-control rs-control--prev">Prev</button> /
					<button class="rs-controls__next rs-control rs-control--next">Next</button>
				</div>
			</div>
		</div>

		<?php
		the_content();
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
