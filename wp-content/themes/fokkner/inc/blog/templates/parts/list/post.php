<article <?php post_class( 'qodef-blog-item qodef-e' ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post media
		fokkner_template_part( 'blog', 'templates/parts/post-info/media' );
		?>
		<div class="qodef-e-content">
			<div class="qodef-e-info qodef-info--top">
				<?php
				// Include post category info
				// fokkner_template_part( 'blog', 'templates/parts/post-info/category' );

				// Include post date info
				fokkner_template_part( 'blog', 'templates/parts/post-info/date' );

				// Include post date info
				fokkner_template_part( 'blog', 'templates/parts/post-info/category' );
				?>
			</div>
			<div class="qodef-e-text">
				<?php
				// Include post title
				fokkner_template_part( 'blog', 'templates/parts/post-info/title', '', array( 'title_tag' => 'h4' ) );

				// Include post excerpt
				fokkner_template_part( 'blog', 'templates/parts/post-info/excerpt' );

				// Hook to include additional content after blog single content
				do_action( 'fokkner_action_after_blog_single_content' );
				?>
			</div>
			<div class="qodef-e-info qodef-info--bottom">
				<div class="qodef-e-info-left">
					<?php
					// Include post author info
					fokkner_template_part( 'blog', 'templates/parts/post-info/author' );

					// Include post author info
					fokkner_template_part( 'blog', 'templates/parts/post-info/comments' );

					// Include post tags info
					fokkner_template_part( 'blog', 'templates/parts/post-info/tags' );
					?>
				</div>
				<div class="qodef-e-info-right">
					<?php
					// Include post read more
					// fokkner_template_part( 'blog', 'templates/parts/post-info/read-more' );

					// Include social share
					do_action( 'fokkner_action_after_blog_single_social_share' );
					?>
				</div>
			</div>
		</div>
	</div>
</article>
