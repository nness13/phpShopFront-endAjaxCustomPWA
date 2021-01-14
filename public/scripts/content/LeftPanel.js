'use strict';

class LeftPanel {
    constructor() {
        this.component = document;
        this.container = '#container';
    }

    init() {
        this.includeJS();

        $('body').on('touchstart', function (e) {
            this.clientXs = e.touches[0].clientX;
            this.clientYs = e.touches[0].clientY;
        });
        $('body').on('touchmove', function (e) {
            if( e.touches[0].clientX > this.clientXs + 10 && app.intRange(e.touches[0].clientY, this.clientYs - 9, this.clientYs + 9) ){
                if( !$('.leftPanel').hasClass('active') ){
                    if(!$(e.originalEvent.target).hasClass("slick-img")){
                        leftPanel.slideRevers_and_logic();
                    }
                }
            }
            if( e.touches[0].clientX < this.clientXs - 10 && app.intRange(e.touches[0].clientY, this.clientYs - 9, this.clientYs + 9) ){
                if( $('.leftPanel').hasClass('active') ){
                    leftPanel.slideRevers_and_logic();
                }
            }
        });

        $('#abroad').on('click', e => {
            leftPanel.slideRevers_and_logic();
        });
        $('#abroad').on('touchstart', function (e) {
            this.clientXa = e.touches[0].clientX;
            this.clientYa = e.touches[0].clientY;
        });
        $('#abroad').on('touchmove', function (e) {
            e.preventDefault();
            let abroadDisplacementX = app.intRange(e.touches[0].clientX, this.clientXa - 10, this.clientXa + 10 ),
                abroadDisplacementY = app.intRange(e.touches[0].clientY, this.clientYa - 20, this.clientYa + 20 );

            if( abroadDisplacementY && abroadDisplacementX ) {
                leftPanel.slideTwoLogic();
                this.blockAbroad = false;
            }

        });

        this.eventActiveLeftMenu = new Event("activeLeftMenu", {bubbles: true});
        this.eventPassiveLeftMenu = new Event("passiveLeftMenu", {bubbles: true});
    }

    includeJS(component = document) {
        this.component = component;

        this.ActiveRouteLeftBox();

    }

    ActiveRouteLeftBox() {
        $('.leftPanel .box a').each(function (){
            if( $(this).hasClass('active')){
                $(this).removeClass('active');
            }
            if( $(this).attr('href') === window.location.pathname ){
                $(this).addClass('active');
                return true;
            }
        });
    }

    // leftMenu
    leftMenu() {
        $('.leftPanel').toggleClass('active');
        if($('.leftPanel').hasClass('active')){
            $('#abroad').addClass('active');
            this.component.dispatchEvent(this.eventActiveLeftMenu);
        }else{
            $('#abroad').removeClass('active');
            this.component.dispatchEvent(this.eventPassiveLeftMenu);
        }
    }

    slideRevers_and_logic(revers = false) {
        if (!$('.leftPanel').hasClass('active')) {
            if(revers){
                this.slide_reverse('Профіль', 'Налаштування');
                this.leftMenu();
            }else{
                this.leftMenu();
            }
        } else {
            if ($('.authBox').hasClass('slide-authBox')) {
                this.slide_reverse('Профіль', 'Налаштування');
                this.leftMenu();
            } else {
                this.leftMenu();
            }
        }
    }

    slideTwoLogic() {
        if(!$('.leftPanel').hasClass('active')){
            this.slide_reverse('Профіль', 'Налаштування');
            this.leftMenu();
        } else{
            this.slide_reverse('Профіль', 'Налаштування');
        }
    }

    slide_reverse(data1, data2) {
        this.slide_authBox(data1);
        this.slide_registerBox(data2);
    }

    slide_authBox(data) {
        $('.authBox').toggleClass('slide-authBox');
    }

    slide_registerBox(data) {
        $('.registerBox').toggleClass('slide-registerBox');
    }

}