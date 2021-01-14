'use strict';

class Kassa {
    constructor() {
        this.component = document;
        this.app = '#App';
        this.container = '#container';
        this.pushpath = 'a#pushpage';
        this.preloader = `<div class="preloader"><div class="cssload-container"><div class="cssload-whirlpool"></div></div></div>`;
    }

    init() {
        this.includeJS();

        document.addEventListener("activeLeftMenu", function(event) {
            $(".leftPanel .topBox .topBtn img").attr("src", "/public/img/magic-lamp-active.svg");
            console.log("Виклик меню");
        });
        document.addEventListener("passiveLeftMenu", function(event) {
            $(".leftPanel .topBox .topBtn img").attr("src", "/public/img/magic-lamp.svg");
            console.log("Закрити меню");
        });

        window.addEventListener('popstate', e => {
            this.pushRender(e.state, 'popstate');
        });

        $(this.app).html(this.preloader);
    }

    includeJS(component = document) {
        this.component = component;

        this.pushpageClickListener();
    }

    














    pushpageClickListener(){
        $(this.pushpath, this.component).click(function (e) {
            e.preventDefault();
            $(this.container).html(this.preloader);
            // app.clearMyInterval();
            // app.setScroll();
            kassa.pushRender($(this).attr('data-href'), $(this).attr('data-type'));
        });
    }

    pushRender(url, type){
        $(this.container).replaceWith(this.Render(url));
        window.history.pushState(url, "", url);
    }


    Render(url, replaceWithDiv){

    }
}