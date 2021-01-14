<div class="container" id="container">
    <link rel="stylesheet" href="/public/styles/module/slick.css">
    <link rel="stylesheet" href="/public/styles/module/slick-theme.css">
    <script data-go="true" src="/public/scripts/module/slick.min.js"></script>
    <script data-go="true" src="/public/scripts/module/shop.js"></script>
    <script>
        $(document).ready(function () {
            $('.JeenSlider').slick({
                arrows: false,
                slidesToShow: 1,
                autoplay: true
            });
        });
    </script>

    <div class="ultra_w h7 m_full_w m_big_h hover_stop" id="hoverDataGoods" prefid="homeSlider">
        <div class="JeenSlider">
            <? foreach ($lastgoods as $key => $val):
                if(file_exists("materials/responsive/goods/".$val['id']."/0.jpg")): ?>
                    <div class="divForImg"><img class="slick-img noscaleImg" src="/materials/responsive/default_img/90OK.gif" lazyLoad="/materials/responsive/goods/<? echo $val['id'] ?>/0.jpg"/></div>
                <?  endif;
            endforeach; ?>
        </div>
        <div class="dataGoods white" style="text-align: center"><br>
            MeCatalog<br><br>
            Техніка для дому, шини, диски та інші товари з європи м.Старий Самбір дивіться у нашому каталозі
            <br><br>
            смт.Стара Сіль вул.Січових Стрільців 12<br><br>
            Пн-Нд: 9:00 - 19:00<br>
            Телефонуйте: 0986385949
            <br><br>
            <div style="display: flex; flex-direction: row; justify-content: space-between">
                <a href="/catalog/all/30/desc/time" id="pushajax" data-type="pushajax" class="btn btn-fantom btn-200">Перейти у каталог</a>
                <div class="btn btn-fantom btn-200" onclick="shop.fullScaleGoodsImgDiv($(`div[prefid='homeSlider']`))">Збільшити</div>
            </div>
        </div>
    </div>

    <script>
        var shop = new Shop();
        app.JeenLazyLoad();
        app.hover_stop();
    </script>
</div>