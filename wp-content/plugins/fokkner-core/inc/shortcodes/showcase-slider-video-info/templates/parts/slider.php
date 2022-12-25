<div class="qodef-main-swiper qodef-m-image-holder" <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
	<div class="swiper-wrapper">
		<?php $counter = 1; ?>
		<?php foreach ( $items as $image_item ) : ?>
			<div class="swiper-slide">
				<?php echo wp_get_attachment_image( $image_item['main_image'], 'full' ); ?>

				<?php
				$total = count( $items );
				?>
				<div class="qodef-m-content-holder">

					<span class="qodef-counter-holder">
						<span class="qodef-counter-current"><?php echo esc_html( str_pad( $counter, 2, '0', STR_PAD_LEFT ) ); ?></span>
						<span class="qodef-counter-total"><?php echo esc_html( str_pad( $total, 2, '0', STR_PAD_LEFT ) ); ?></span>
					</span>

					<?php if ( isset( $image_item['slider_title'] ) && ! empty( $image_item['slider_title'] ) ) { ?>
						<h1 class="qodef-m-title"><?php echo qode_framework_wp_kses_html( 'content', $image_item['slider_title'] ); ?></h1>
					<?php } ?>

					<?php
					$button_params = array(
						'button_layout' => 'outlined',
						'link'          => ! empty( $image_item['item_button_link'] ) ? $image_item['item_button_link'] : '',
						'text'          => ! empty( $image_item['item_button_text'] ) ? $image_item['item_button_text'] : esc_html__( 'Make an enquiry', 'fokkner-core' ),
					);
					?>

					<?php if ( ! empty( $button_params ) && ! empty( $button_params['link'] ) && class_exists( 'FokknerCore_Button_Shortcode' ) ) { ?>
						<div class="qodef-m-button">
							<?php echo FokknerCore_Button_Shortcode::call_shortcode( $button_params ); ?>
						</div>
					<?php } ?>

				</div>

				<?php if ( ! empty( $image_item['info_title'] ) || ! empty( $image_item['info_text'] ) || ! empty( $image_item['info_video_link'] ) || ! empty( $image_item['info_video_image'] ) ) { ?>
					<?php
					$holder_classes   = array();
					$holder_classes[] = 'qodef-m-info';
					$holder_classes[] = ! empty( $image_item['info_video_link'] ) && ! empty( $image_item['info_video_image'] ) ? 'qodef-info-has--video' : '';
					$holder_classes[] = 'yes' === $image_item['disable_title_break_words'] ? 'qodef-title-break--disabled' : '';

					$holder_classes = implode( ' ', $holder_classes );
					?>
				<?php } ?>

			</div>
			<?php $counter ++; ?>
		<?php endforeach; ?>
	</div>
</div>
<div class="qodef-additional-swiper" <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
    <div class="swiper-wrapper">
        <?php $counter = 1; ?>
        <?php foreach ( $items as $image_item ) : ?>
            <div class="swiper-slide">
                <div <?php qode_framework_class_attribute( $holder_classes ); ?>>
                    <div class="qodef-m-info-holder">
                        <div class="qodef-m-text-holder">
                            <?php if ( ! empty( $image_item['info_title'] ) ) {
                                $title = $image_item['info_title'];

                                $text_break = '<br>';
                                if ( ! empty( $image_item['line_break_positions'] ) ) {
                                    $split_title          = explode( ' ', $title );
                                    $line_break_positions = explode( ',', str_replace( ' ', '', $image_item['line_break_positions'] ) );

                                    foreach ( $line_break_positions as $position ) {
                                        if ( isset( $split_title[ $position - 1 ] ) && ! empty( $split_title[ $position - 1 ] ) ) {
                                            $split_title[ $position - 1 ] = $split_title[ $position - 1 ] . $text_break;
                                        }
                                    }

                                    $title = implode( ' ', $split_title );
                                }
                                ?>
                                <h4 class="qodef-m-info-title"><?php echo qode_framework_wp_kses_html( 'content', $title ); ?></h4>
                            <?php } ?>

                            <?php if ( ! empty( $image_item['info_text'] ) ) { ?>
                                <p class="qodef-m-info-text"><?php echo qode_framework_wp_kses_html( 'content', $image_item['info_text'] ); ?></p>
                            <?php } ?>
                        </div>

                        <?php
                        $video_button_params = array(
                            'video_link'  => ! empty( $image_item['info_video_link'] ) ? $image_item['info_video_link'] : '',
                            'video_image' => ! empty( $image_item['info_video_image'] ) ? $image_item['info_video_image'] : '',
                        );
                        ?>

                        <?php if ( ! empty( $video_button_params ) && ! empty( $video_button_params['video_link'] ) && ! empty( $video_button_params['video_image'] ) && class_exists( 'FokknerCore_Video_Button_Shortcode' ) ) { ?>
                            <?php echo FokknerCore_Video_Button_Shortcode::call_shortcode( $video_button_params ); ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php $counter ++; ?>
        <?php endforeach; ?>
    </div>
</div>