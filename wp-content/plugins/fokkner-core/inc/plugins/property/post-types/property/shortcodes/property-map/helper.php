<?php

if ( ! function_exists( 'fokkner_core_property_map_filter_query' ) ) {
	/**
	 * Function to adjust query for store list parameters
	 */
	function fokkner_core_property_map_filter_query( $args, $params ) {
		if ( ! empty( $params['custom_search'] ) ) {
			$args['s'] = esc_attr( $params['custom_search'] );
			// if orderby not set, set default for search
			if ( empty( $args['orderby'] ) ) {
				$args['orderby'] = 'relevance';
			}
		}

		return $args;
	}

	add_filter( 'fokkner_filter_query_params', 'fokkner_core_property_map_filter_query', 10, 2 );
}

if ( ! function_exists( 'fokkner_core_get_property_map_filter' ) ) {
	function fokkner_core_get_property_map_filter( $type, $params ) {
		$item_params = array();

		if ( 'yes' !== $params[ 'property_enable_filter_' . $type ] ) {
			return;
		}

		$item_params['filter_type'] = $type;
		$item_params['value']       = false;

		if ( 'tax' === $params['additional_params'] ) {

			for ( $i = 1; $i <= 3; $i ++ ) {
				if ( '' !== strpos( $params[ 'tax_' . $i ], $type ) && ( $params[ 'tax_slug_' . $i ] !== '' || $params[ 'tax__in_' . $i ] ) ) {
					$item_params['value'] = ! empty( $params[ 'tax_slug_' . $i ] ) ? $params[ 'tax_slug_' . $i ] : $params[ 'tax__in_' . $i ];
				}
			}
		}

		switch ( $type ) {
			case 'custom_search':
				$item_params['field_type']    = 'text';
				$item_params['default_label'] = esc_html__( 'What you are looking for?', 'fokkner-core' );
				$item_params['terms']         = true;
				$item_params['value']         = isset( $params['custom_search'] ) && ! empty( $params['custom_search'] ) ? $params['custom_search'] : '';
				break;

			case 'location':
				$item_params['field_type']    = 'select';
				$item_params['default_label'] = esc_html__( 'All Locations', 'fokkner-core' );
				$item_params['terms']         = qode_framework_get_cpt_taxonomy_items( 'stores-' . $type, false, true );
				break;

			case 'category':
				$item_params['field_type']    = 'select';
				$item_params['default_label'] = esc_html__( 'All Categories', 'fokkner-core' );
				$item_params['terms']         = qode_framework_get_cpt_taxonomy_items( 'stores-' . $type, false, true );
				break;
		}

		// get relation terms value
		if ( is_tax( 'property-category' ) && 'order_by' !== $type ) {
			$relation_terms_meta = get_term_meta( get_queried_object_id(), 'qodef_property_category_relation_tags', true );
			$relation_terms      = array();

			if ( ! empty( $relation_terms_meta ) ) {
				foreach ( $relation_terms_meta as $relation_term_id ) {
					$relation_terms[ $relation_term_id ] = qode_framework_get_cpt_taxonomy_name_by_ids( $relation_term_id );
				}
			}

			$item_params['terms'] = ! empty( $relation_terms ) ? $relation_terms : $item_params['terms'];
		}

		// disable filter section if terms is empty
		if ( empty( $item_params['terms'] ) ) {
			return;
		}

		fokkner_core_template_part( 'post-types/stores/shortcodes/store-list', 'templates/filter/filter-item', '', $item_params );
	}
}

if ( ! function_exists( 'fokkner_core_store_add_multiple_vars_pagination' ) ) {
	/**
	 * Function that extended global pagination options for this module
	 *
	 * @param array $data
	 * @param array $options
	 *
	 * @return array
	 */
	function fokkner_core_store_add_multiple_vars_pagination( $data, $options ) {

		if ( 'property-map' === $options['shortcode'] ) {
			$query_args = fokkner_core_get_query_params( $options );

			$data['addresses']     = fokkner_core_set_multiple_map_variables( $query_args );
			$data['max_num_pages'] = $options['query_result']->max_num_pages;

			if ( empty( $options['pagination_type_load_more_top_margin'] ) ) {
				$options['pagination_type_load_more_top_margin'] = '';
			}
		}

		return $data;
	}

	add_filter( 'fokkner_filter_pagination_data_return', 'fokkner_core_store_add_multiple_vars_pagination', 10, 2 );
}
