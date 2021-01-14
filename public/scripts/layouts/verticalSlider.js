'use strict';

class verticalSlider {
    constructor() {
        this.component = document;
        this.fullpg = '#fullpg';
    }

    init() {
        this.includeJS();

    }

    includeJS(component = document) {
        $(slider.fullpg).on( 'DOMMouseScroll mousewheel', function ( event ) {
            if( event.originalEvent.detail > 0 || event.originalEvent.wheelDelta < 0) {
                $(slider.fullpg).slick('slickNext');
            } else {
                $(slider.fullpg).slick('slickPrev');
            }
        });
        $(window).on( 'keydown', function ( event ) {
            if( event.code === 'ArrowDown' || event.code === 'Space' ) {
                $(slider.fullpg).slick('slickNext');
            }else if( event.code === 'ArrowUp' ){
                $(slider.fullpg).slick('slickPrev');
            }
        });
        $('.topBtn').on( 'click', function () {
            $(slider.fullpg).slick('slickGoTo', 0);
        } )
    }

}