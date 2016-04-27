<div class="bios-image">
	<?php if (has_post_thumbnail( $post->ID ) ) : ?>
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'bph-bio-thumbnail' ); ?>
		<img src="<?php echo $image[0]; ?>"/>
	<?php endif; ?>
</div>
