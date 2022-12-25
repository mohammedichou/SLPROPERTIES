<div class="qodef-e-media">
	<?php
	switch ( get_post_format() ) {
		case 'gallery':
			fokkner_template_part( 'blog', 'templates/parts/post-format/gallery' );
			break;
		case 'video':
			fokkner_template_part( 'blog', 'templates/parts/post-format/video' );
			break;
		case 'audio':
			fokkner_template_part( 'blog', 'templates/parts/post-format/audio' );
			break;
		default:
			fokkner_template_part( 'blog', 'templates/parts/post-info/image' );
			break;
	}
	?>
</div>
