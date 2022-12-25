(function ( $ ) {
	'use strict';

	var shortcode = 'fokkner_core_blog_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

	$( window ).on(
		'load',
		function () {
			qodefBlogList.init();
		}
	);

	var qodefBlogList = {
		init: function () {
			this.blog = $('.qodef-blog');

			if ( this.blog.length ) {
				this.blog.each(
					function () {
						var $thisBlogList = $( this );

						if ( $thisBlogList.hasClass('qodef-hover-animation--enabled') ) {
							qodefBlogList.linkHover( $thisBlogList );
						}
					}
				)
			}
		},
		linkHover: function ( $holder ) {
			var $items = $holder.find('.qodef-blog-item');

			$items.each( function() {
				var $thisItem = $(this),
					$itemMedia = $thisItem.find('.qodef-e-media-image'),
					$titleLink = $thisItem.find('.qodef-e-title-link');

				$itemMedia.on(
					'mouseenter',
					function () {
						$thisItem.addClass('qodef--active');
					}
				);

				$itemMedia.on(
					'mouseleave',
					function () {
						$thisItem.removeClass('qodef--active');
					}
				);

				$titleLink.on(
					'mouseenter',
					function () {
						$thisItem.addClass('qodef--active');
					}
				);

				$titleLink.on(
					'mouseleave',
					function () {
						$thisItem.removeClass('qodef--active');
					}
				);
			});
		}
	}

	qodefCore.shortcodes[shortcode].qodefResizeIframes = qodef.qodefResizeIframes;
	qodefCore.shortcodes[shortcode].qodefBlogList = qodefBlogList;

})( jQuery );