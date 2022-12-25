<?php
// Unique ID for search form fields
$qodef_unique_id = uniqid( 'qodef-search-form-' );
?>
<form role="search" method="get" class="qodef-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $qodef_unique_id ); ?>" class="screen-reader-text"><?php esc_html_e( 'Search for:', 'fokkner' ); ?></label>
	<div class="qodef-search-form-inner clear">
		<input type="search" id="<?php echo esc_attr( $qodef_unique_id ); ?>" class="qodef-search-form-field" value="" name="s" placeholder="<?php esc_attr_e( 'Search', 'fokkner' ); ?>" />
		<button type="submit" class="qodef-search-form-button">
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			     width="12px" height="12px" viewBox="-1 -1 14 14" style="enable-background:new 0 0 12 12;" xml:space="preserve">
				<g>
					<path d="M11.1,12c-0.2,0-0.5-0.1-0.6-0.3L8,9.3c-0.8,0.6-1.9,0.9-2.9,0.9C2.3,10.2,0,7.9,0,5.1S2.3,0,5.1,0
						s5.1,2.3,5.1,5.1c0,1-0.3,2-0.9,2.9l2.5,2.5c0.2,0.2,0.3,0.4,0.3,0.6C12,11.6,11.6,12,11.1,12z M5.1,1.8c-1.8,0-3.2,1.4-3.2,3.2
						s1.4,3.2,3.2,3.2s3.2-1.4,3.2-3.2S6.9,1.8,5.1,1.8z"/>
				</g>
			</svg>
		</button>
	</div>
</form>
