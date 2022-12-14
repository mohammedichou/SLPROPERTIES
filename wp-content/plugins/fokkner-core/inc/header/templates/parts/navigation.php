<?php if ( has_nav_menu( 'main-navigation' ) ) : ?>
	<nav class="qodef-header-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'fokkner-core' ); ?>">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'main-navigation',
				'container'      => '',
				'link_before'    => '<span class="qodef-menu-item-text">',
				'link_after'     => '</span>',
				'walker'         => new FokknerCoreRootMainMenuWalker(),
			)
		);
		?>
	</nav>
<?php endif; ?>
