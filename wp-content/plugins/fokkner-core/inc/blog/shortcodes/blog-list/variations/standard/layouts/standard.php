<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post media
		fokkner_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/media', '', $params );
		?>
		<div class="qodef-e-content">
			<div class="qodef-e-info qodef-info--top">
				<?php
				// Include post category info
				// fokkner_core_theme_template_part( 'blog', 'templates/parts/post-info/category' );

				// Include post date info
				fokkner_core_theme_template_part( 'blog', 'templates/parts/post-info/date' );
				?>
			</div>
			<div class="qodef-e-text">
				<?php
				// Include post title
				fokkner_core_theme_template_part( 'blog', 'templates/parts/post-info/title', '', $params );

				// Include post excerpt
				fokkner_core_theme_template_part( 'blog', 'templates/parts/post-info/excerpt', '', $params );

				// Hook to include additional content after blog single content
				do_action( 'fokkner_action_after_blog_single_content' );
				?>
			</div>
			<div class="qodef-e-info qodef-info--bottom">
				<div class="qodef-e-info-left">
					<?php
					// Include post author info
					fokkner_core_theme_template_part( 'blog', 'templates/parts/post-info/author' );

					// Include post comments info
					fokkner_core_theme_template_part( 'blog', 'templates/parts/post-info/comments' );

					// Include post category info
					fokkner_core_theme_template_part( 'blog', 'templates/parts/post-info/tags' );
					?>
				</div>
				<div class="qodef-e-info-right">
					<?php
					// Include post read more
					// fokkner_core_theme_template_part( 'blog', 'templates/parts/post-info/read-more' );

					// Include social share
					do_action( 'fokkner_action_after_blog_single_social_share' );
					?>
				</div>
			</div>
		</div>
	</div>
</article>
