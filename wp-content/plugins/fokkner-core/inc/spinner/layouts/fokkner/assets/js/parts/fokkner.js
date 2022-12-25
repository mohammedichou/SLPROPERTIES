(function ($) {
    "use strict";

    $( document ).ready(
        function () {
            qodefFokknerSpinner.init();
        }
    );

    $( window ).on(
        'load',
        function () {
            qodefFokknerSpinner.windowLoaded = true;
        }
    );

    $( window ).on(
        'elementor/frontend/init',
        function() {
            var isEditMode = Boolean( elementorFrontend.isEditMode() );

            if ( isEditMode ) {
                qodefFokknerSpinner.init( isEditMode );
            }
        }
    );

    var qodefFokknerSpinner = {
        init: function ( isEditMode ) {
            var $holder = $('#qodef-page-spinner.qodef-layout--fokkner');

            if ( $holder.length ) {
                if ( isEditMode ) {
                    qodefFokknerSpinner.fadeOutLoader( $holder );
                } else {
                    qodefFokknerSpinner.animateSpinner( $holder );
                }
            }
        },
        animateSpinner: function ( $holder ) {
            $holder.addClass('qodef--init');

            var $revSlider = $( '#qodef-main-rev-holder rs-module' );

            setTimeout(
                function () {
                    $holder.addClass('qodef--animate');
                }, 800
            )

            setTimeout(
                function () {
                    if ( qodefFokknerSpinner.windowLoaded ) {
                        qodefFokknerSpinner.fadeOutLoader( $holder );

                        if ( $revSlider.length ) {
                            $revSlider.revstart();
                        }
                    } else {
                        var interval = setInterval(
                            function() {
                                if ( qodefFokknerSpinner.windowLoaded ) {
                                    clearInterval(interval);

                                    qodefFokknerSpinner.fadeOutLoader( $holder );

                                    if ( $revSlider.length ) {
                                        $revSlider.revstart();
                                    }
                                }
                            }, 100
                        );
                    }
                }, 3000
            );
        },
        fadeOutLoader: function ($holder, speed, delay, easing) {
            speed = speed ? speed : 500;
            delay = delay ? delay : 0;
            easing = easing ? easing : 'swing';

            if ($holder.length) {
                $holder.delay(delay).fadeOut(speed, easing);
                $(window).on('bind', 'pageshow', function (event) {
                    if (event.originalEvent.persisted) {
                        $holder.fadeOut(speed, easing);
                    }
                });
            }
        }
    };

})(jQuery);