'use strict';

class DefaultLayout {
    constructor() {
        this.component = document;
        this.container = '#container';
    }

    init() {
        this.includeJS();

        document.querySelector('.searchInput').addEventListener('input', function() {
            if(this.value.length < 50){
                app.onclickSend('/catalog/search/30/desc/time', 'search', '&val='+this.value);
            }else{
                swal.fire('Не більше 20 символів для пошуку');
            }
        });

        setTimeout( () => {
            this.messageRightPanel();
        }, 3000)
    }

    includeJS(component = document) {
        this.component = component;

        this.settingsAccount();
        this.getCategory();
        this.clickTupCategory();
        this.activeBlockScroll();
        // this.cornersDiv();
        $(this.container+' div#hoverDataGoods').hover(
            function () {
                $(this).addClass('hover');
            },
            function () {
                $(this).removeClass('hover');
            }
        );
    }

    activeBlockScroll(){
        let offsetTopEl = $(this.container+' div#hoverDataGoods'),
            previosEl = [];

        if(offsetTopEl){
            $(this.container).scroll(function () {
                let el = '',
                    offset = '',
                    scrollHeight = document.querySelector(defaultLayout.container).scrollHeight,
                    xObl = $(defaultLayout.container).scrollTop()/scrollHeight,
                    meredian = $(defaultLayout.container).height()*xObl*1.5
                ;
                $.each(offsetTopEl, function () {
                    el = $(this);
                    offset = el.offset();

                    if( offset.top >= meredian && offset.top <= meredian + 25 ){
                        el.addClass('hover');
                        if(previosEl[0] && $(previosEl[0]).offset().top === offset.top){
                            previosEl.push(el);
                        }else{
                            $.each(previosEl, function () {
                                $(this).removeClass('hover');
                            });
                            previosEl = [el]
                        }
                    }
                });
            });
        }
    }

    cornersDiv(){
        $(this.container).children().each(function (id, val) {
            const   left = $(val).offset().left,
                    top = $(val).offset().top,
                    right = $(val).offset().right,
                    bottom = $(val).offset().bottom;
            let t = '',l = '',myVar;

            if( left === $(defaultLayout.container).offset().left ){
                l = `translateX(${ $(val).width()*1.155 - $(val).width() }px)`;
                console.log(l)

            }
            if( top === $(defaultLayout.container).offset().top ){
                t = `translateY(${ $(val).height()*1.155 - $(val).height() }px)`;
                console.log(t)

            }
            if( right === $(defaultLayout.container).offset().right ){

            }
            if( bottom === $(defaultLayout.container).offset().bottom  ){

            }

            $(val).hover(
                function (){
                    $(val).css({
                        'transform':`scale(1.4) ${l} ${t}`,
                        'z-index': 5
                    })
                    clearTimeout(myVar);
                },
                function (){
                    $(val).css({'transform':''})
                    myVar = setTimeout(function () {
                        $(val).css({'z-index': 'auto'});
                    },50)
                }
            );
        })
    }


    settingsAccount() {
        $('input[id="password"]', this.component).change(function () {
                app.onclickSend('/account/settings', 'updatePassword', "&password=" + $(this).val());
        });
        $('input[id="number"]', this.component).change(function () {
            app.onclickSend('/account/settings', 'updateNumber', "&number=" + $(this).val());
        });
        $('input[id="login"]', this.component).change(function () {
            app.onclickSend('/account/settings', 'updateLogin', "&login=" + $(this).val());
        });
        $('#newCategory', this.component).change(function () {
            app.onclickSend('/new/goods', 'newCategory', "&category=" + $(this).val());
        });
    }

    focusInputSearch() {
        $('.searchInput').addClass('searchInputActive');
        $('.lineLupe').css({'display' : 'none'});
        $('.searchInput').attr("placeholder", "Знайти");
        $('.searchInput').val(window.valSearchInp);
    }

    blurInputSearch() {
        $('.searchInput').removeClass('searchInputActive');
        $('.lineLupe').css({'display' : 'block'});
        window.valSearchInp = $('.searchInput').val();
        $('.searchInput').val('');
        $('.searchInput').attr("placeholder", "");
    }

    categoryToggle() {
        let
            path = window.location.pathname.split('/'),
            htmlItem = '';

        $('#divInputSearch').html("<div class='divInputSearchText' >Категорії</div>");
        $('#category_geed_menu').toggleClass('geed_menu_active');
        $('#divInputSearch').toggleClass('search-menu-active');

        if(path[1] == 'catalog'){
            let thispath = '/catalog/'+ path[2] +'/'+ path[3] +'/';
            let filters = '<div class="big_w small_h m_full_w"><div class="content_card noanim"><div class="btn-text">Сортовати: <a onclick="app.onclickSend(\''+ thispath +'desc/time\', \'sorting\')">Нові</a> <a onclick="app.onclickSend(\''+ thispath +'desc/price\', \'sorting\')">Дорогі</a> <a onclick="app.onclickSend(\''+ thispath +'asc/price\', \'sorting\')">Дешеві</a></div></div></div>';
            htmlItem = filters;
        }else{
            htmlItem = '';
        }

        const categoryList = JSON.parse(localStorage.getItem("category"));
        if (categoryList != null) {
            categoryList.forEach(function(item, i, arr) {
                htmlItem += "<div class='small_w small_h m_fifty_w'><a onclick='app.onclickSend(\"/catalog/cat_"+ item['id'] +"/30/asc/time\", \"sorting\")' class='contentCenter'>" + item['name'] + "</a></div>"
            });
            $('#containerCategory').html(htmlItem);
        }else{
            alert('error');
        }
    }

    getCategory() {
        let data = {
            'getCategory_f' :'yes',
            'namespace':'specialspace1'
            },
            json = null;

        $.ajax({
            type: 'POST',
            url: '/api/category',
            data: data,
            success: function(result) {
                json = jQuery.parseJSON(result);
                localStorage.setItem("category", JSON.stringify(json.data));
            }
        });
    }

    clickTupCategory() {
        $('.tup_category', this.component).on('click', this.categoryToggle);

    }

    oneCategory(name) {
        $('#category').val('');
        $('#inputTags').html('<input class="tagsItems white" form="formGoods" name="category" value="'+name+'" readonly>');
        this.categoryOpen();
    }

    categoryOpen() {
        let htmlItem = '';
        $('#divInputSearch').html("<div class='divInputSearchText' >Категорії</div>");
        $('#category_geed_menu').toggleClass('geed_menu_active');
        $('#divInputSearch').toggleClass('search-menu-active');
        const categoryList = JSON.parse(localStorage.getItem("category"));
        if (categoryList != null) {
            categoryList.forEach(function(item, i, arr) {
                htmlItem += '<div class="small_w small_h m_fifty_w"><div onclick="defaultLayout.oneCategory(`' + item['name'] + '`)" class="contentCenter">' + item['name'] + '</div></div>'
            });
            $('#containerCategory').html(htmlItem)
        }else{
            alert('error');
        }
    }

    selectCategory(){
        $('#category-butt').click(defaultLayout.categoryOpen);
    }

    messageRightPanel(){
        $(function () {
            $('.rightPanel').append('<div id="androidAppMessage" style="position: absolute; right: 40px; bottom: 33px; border: 1px inset #09091a; padding: 5px; width: 230px; text-align: center; border-radius: 0 90px 90px 0; background: #09091a; color: #f1f1f1;   -webkit-box-shadow: 4px 4px 0 rgba(0, 0, 0, 0.2); box-shadow: 4px 4px 0 rgba(0, 0, 0, 0.2);">Часто використовуєш наш сервіс завантажуй додаток на андроїд</div>');
            setTimeout(function () {
                $('#androidAppMessage').remove();
            }, 5000)

        })
    }
}