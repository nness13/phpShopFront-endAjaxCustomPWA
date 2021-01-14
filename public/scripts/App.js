'use strict';

class App {
    constructor(){
        this.component = document;
        this.container = '#container';
        this.preloader = "<div class=\"preloader\"><div class=\"cssload-container\"><div class=\"cssload-whirlpool\"></div></div></div>"
    }

    init(){
        this.includeJS();

        this.addListenerPushajax();

        $(document).on('input', 'input[inputChange=inputChange]', app.inputChangePlace);
        $(document).on('input', 'input:password', app.passwordChangePlace);
    }

    includeJS(component = document){
        this.component = component;

        this.formSend();
        this.pushAjaxListener();
    }

    addListenerPushajax(){
        document.addEventListener("pushAjaxEvent", e => {
            this.includeJS($(e.detail.path));
            if(typeof(defaultLayout) != "undefined"){
                defaultLayout.includeJS($(e.detail.path));
            }
        });
        document.addEventListener("appendAjaxEvent", e => {
            this.includeJS(e.detail.object);
            if(typeof(defaultLayout) != "undefined") {
                defaultLayout.includeJS($(e.detail.path));
            }
        });
        window.addEventListener('popstate', e => {
            this.onclickSend(e.state, 'popstate', '', '');
        });
    }

    formSend() {
        const path = 'form';
        $(path, this.component).submit(function (event) {
            event.preventDefault();
            let data = new FormData(this);
                data.append('namespace', 'specialspace1');
                data.append( $(this).attr('name')+'_form', 'name');
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data:  data,
                contentType: false,
                cache: false,
                async: true,
                processData: false,
                success: function(result) {
                    app.viewAjax(jQuery.parseJSON(result));
                },
            });
        });
    }

    // onclickSend('/diller/goods', 'name', '&data1=val', 'idinput')"
    onclickSend( url, name = '', data1 = '', input = '') {
        let str = '';
        $.each(input.split('.'), function(k, v) {
            if (input) {
                str += '&' + v + '=' + $('#' + v).val();
            }
        });
        let data = name + '_f=1' + '&namespace=specialspace1' + data1 + str;
        if(name === "pushajax") app.animateContentLoader();
        $.ajax({
            url : url,
            type: 'POST',
            data: data,
            success: function( result ) {
                app.viewAjax(jQuery.parseJSON(result));
            }
        });
    }

    viewAjax(json) {
        if(json.message && json.action) {
            swal.fire(json.message).then(()=> { this.ajaxResponseSwitch(json.action); });
        }
        else if(json.message) {
            swal.fire(json.message);
        }
        else if(json.action) {
            this.ajaxResponseSwitch(json.action);
        }
    }

    ajaxResponseSwitch(action) {
        if(action.closeMenu){
            defaultLayout.slideRevers_and_logic();
        }
        if(action.refreshContainer === true){
            this.onclickSend(window.location.pathname, 'pushajax');
        }
        switch (action.act) {
            case 'pushajax':
                window.history.pushState(action.newurl, "", action.newurl);
                app.pushajaxLoaderContent(action);
                break;
            case 'popState':
                this.pushajaxLoaderContent(action);
                break;
            case 'ViewAjax':
                if(action.html){
                    $.each(action.html, function(k, v) {
                        app.pushajaxLoaderHtml(v, k);
                    });
                }
                if(action.append){
                    $.each(action.append, function(k, v) {
                        app.appendAjaxLoaderHtml(v, k);
                    });
                }
                if(action.removeHTML){
                    $.each(action.removeHTML, function(k, v) {
                        $(v).remove();
                    });
                }
                break;
            case 'backHistory':
                window.history.back();
                break;
            case 'go':
                window.location.pathname = '/' + action.url;
                break;
            case 'contentRedirect':
                this.onclickSend(action.url, 'pushajax');
                break;
            case 'clearnSearch':
                window.valSearchInp = '';
                break;
        }
        if(action.pathmap){
            $('#map').html(action.pathmap);
        }
        if(action.sorting === 'catmenu'){
            defaultLayout.categoryToggle();
        }
    }

    pushajaxLoaderContent(action) {
        this.pushajaxLoaderHtml(action.content, this.container);
        document.title = action.title;
        leftPanel.ActiveRouteLeftBox();
    }

    pushajaxLoaderHtml(html, path) {
        $(path).replaceWith(html);
        app.createEventPushAjaxEvent(path);
    }

    appendAjaxLoaderHtml(html, path) {
        $(path).append(html);
        app.createEventAppendAjaxEvent(html);
    }

    createEventPushAjaxEvent(path){
        let event = new CustomEvent("pushAjaxEvent", {
            detail: { path: path }
        });
        document.dispatchEvent(event);
    }

    createEventAppendAjaxEvent(path){
        let event = new CustomEvent("appendAjaxEvent", {
            detail: { object: path }
        });
        document.dispatchEvent(event);
    }

    pushAjaxListener() {
        let path = 'a#pushajax';
        $(path, this.component).click(function (event) {
            event.preventDefault();
            app.clearMyInterval();
            app.onclickSend($(this).attr('href'), $(this).attr('data-type'));
        });
    }

    animateContentLoader(){
        let bufferHTML = $(this.container).clone(true);
        $(this.container).html(this.preloader);
    }

    clearMyInterval(){
        if(window.myInterval){
            clearInterval(window.myInterval);
        }
    }

    JeenLazyLoad(){
        $(function () {
            $.each($('img[lazyLoad]', this.component), function () {
                $(this).attr("src", $(this).attr("lazyLoad"));
                $(this).removeAttr("lazyLoad");
            });
        });
    }

    pagination(){
        let block = false;
        $(this.container).scroll(function () {
            let
                data = null,
                json = null,
                route = window.location.pathname.split('/'),
                startFrom = Number(route[3]),
                scrollBottom = $(app.container).scrollTop() + $(app.container).height() + 100,
                scrollHeight = document.querySelector(app.container).scrollHeight;

            if (scrollBottom >= scrollHeight && !block) {
                console.log('Початок', startFrom);
                let timepath = "/catalog/" + route[2] + "/" + startFrom + "/" + route[4] + "/" + route[5];
                $.ajax({
                    beforeSend: function () {
                        block = true;
                        window.history.replaceState(timepath, "", timepath);
                    },
                    type: 'POST',
                    url: timepath,
                    data: data = {
                        'pagination_f': 'name',
                        'startFrom': startFrom,
                        'namespace': 'specialspace1'
                    },
                    async: false,
                    success: function (result) {
                        json = jQuery.parseJSON(result);
                        let HtmLet = $('#hoverDataGoods', json.data).unwrap();
                        $(app.container).append(HtmLet);
                        app.createEventAppendAjaxEvent(HtmLet);
                        app.JeenLazyLoad()
                        if (json.max < 30) {
                            // console.log('ласт');
                            block = true;
                        }else{
                            block = false;
                            // console.log('некст');
                        }
                        startFrom += json.max;
                        window.history.replaceState(json.max, "", "/catalog/" + route[2] + "/" + startFrom + "/" + route[4] + "/" + route[5]);
                    }
                });
            }
        });
    }

    /*  InputModule  */
    inputChangePlace(){
        let there = $(this),
            label = $(this).prev();
        if(this.value){
            there.addClass('inputwrite');
            label.addClass('labelwrite');
        }else{
            there.removeClass('inputwrite');
            label.removeClass('labelwrite');
        }
    }

    passwordChangePlace(){
        let parent = $(this).parent();

        if(this.value){
            if(!$('#passButton', parent).length){
                parent.append('<div id="passButton" onclick="app.passwordText(this)">Показати</div>');
            }
        }else{
            if($('#passButton', parent).length){
                $('#passButton', parent).remove();
            }
        }
    }
    passwordText(el) {
        let attr = '',
            passButton = $(el),
            prev = passButton.prev(),
            text = '';
        if(prev.attr('type') === 'password'){
            attr = 'text';
            text = 'Сховати';
        }else{
            attr = 'password';
            text = 'Показати';
        }
        prev.attr('type', attr);
        passButton.text(text);
    }


    intRange( int, min, max) {
        if(int >= min && int <= max){
            return true;
        }else{
            return false
        }
    }

    hover_stop() {
        $(".hover_stop").on("click", function () {
            $(this).toggleClass("hover_stop");
        })
    }
}