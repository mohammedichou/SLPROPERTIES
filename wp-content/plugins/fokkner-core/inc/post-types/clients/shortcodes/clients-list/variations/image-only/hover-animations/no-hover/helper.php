<?php

if ( ! function_exists( 'fokkner_core_filter_clients_list_image_only_no_hover' ) ) {
    /**
     * Function that add variation layout for this module
     *
     * @param array $variations
     *
     * @return array
     */
    function fokkner_core_filter_clients_list_image_only_no_hover( $variations ) {
        $variations['no-hover'] = esc_html__( 'No Hover', 'fokkner-core' );

        return $variations;
    }

    add_filter( 'fokkner_core_filter_clients_list_image_only_animation_options', 'fokkner_core_filter_clients_list_image_only_no_hover' );
}