<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-e-inner">
		<div class="qodef-e-pit-header">
			<?php for ( $i = 1; $i <= 6; $i ++ ) { ?>
				<div class="qodef-e-pit-header-item qodef-e-pit-item">
					<div class="qodef-e-pit-item-inner">
						<<?php echo esc_html( $title_tag ); ?> class="qodef-e-pit-header-title"><?php echo esc_html( $params[ 'title_' . $i ] ); ?></<?php echo esc_html( $title_tag ); ?>>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="qodef-e-pit-content">
			<div class="qodef-e-pit-content-inner">
				<?php foreach ( $items as $item ) { ?>
					<div class="qodef-e-pit-row">
						<?php for ( $i = 1; $i <= 6; $i ++ ) { ?>
							<div class="qodef-e-pit-content-item qodef-e-pit-item">
								<div class="qodef-e-pit-item-inner">
									<div class="qodef-e-pit-item-content qodef-pit-type--<?php echo esc_html( $item[ 'text_' . $i . '_type' ] ); ?>">
										<?php
										if ( 'button' === $item[ 'text_' . $i . '_type' ] ) {
											$button_params = array(
												'button_layout' => 'textual',
												'text'          => $item[ 'button_text_' . $i ],
												'link'          => $item[ 'button_' . $i . '_link' ],
												'target'        => $item[ 'button_' . $i . '_target' ],
											);

											echo FokknerCore_Button_Shortcode::call_shortcode( $button_params );
										} else {
											echo esc_html( $item[ 'text_' . $i ] );
										}
										?>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="qodef-e-inner-responsive">
		<div class="qodef-e-content-responsive">
			<?php foreach ( $items as $item ) { ?>
			<div class="qodef-e-pit-row">
				<?php for ( $i = 1; $i <= 6; $i ++ ) { ?>
					<div class="qodef-e-pit-content-item-resposnive qodef-e-pit-item-responsive">
						<div class="qodef-e-pit-responsive-header">
							<<?php echo esc_html( $title_tag ); ?> class="qodef-e-pit-header-title"><?php echo esc_html( $params[ 'title_' . $i ] ); ?></<?php echo esc_html( $title_tag ); ?>>
						</div>
						<div class="qodef-e-pit-responsive-content">
							<div class="qodef-e-pit-item-content qodef-pit-type--<?php echo esc_html( $item[ 'text_' . $i . '_type' ] ); ?>">
								<?php
								if ( 'button' === $item[ 'text_' . $i . '_type' ] ) {
									$button_params = array(
										'button_layout' => 'textual',
										'text'          => $item[ 'button_text_' . $i ],
										'link'          => $item[ 'button_' . $i . '_link' ],
										'target'        => '_blank',
									);

									echo FokknerCore_Button_Shortcode::call_shortcode( $button_params );
								} else {
									echo esc_html( $item[ 'text_' . $i ] );
								}
								?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
