<div class="container" id="container">
    <link rel="stylesheet" href="/public/styles/module/slick.css">
    <link rel="stylesheet" href="/public/styles/module/slick-theme.css">
    <script data-go="true" src="/public/scripts/module/slick.min.js"></script>
    <script data-go="true" src="/public/scripts/module/shop.js"></script>
    <script>
        $(function () {
            $('.JeenSlider').slick({
                arrows: false,
                slidesToShow: 1,
                dots: true,
                autoplay: true
            });
        });
    </script>

    <div class="double_w big_h m_full_w m_4_h" onclick="shop.fullScaleGoodsImgDiv(this)">
        <div class="JeenSlider">
        <? for ($i = 0; $i <= 4; $i++):
            if(file_exists("materials/responsive/goods/".$list['id']."/$i.jpg")): ?>
                <div class="divForImg"><img class="slick-img noscaleImg" src="/materials/responsive/default_img/90OK.gif" lazyLoad="/materials/responsive/goods/<? echo $list['id'] ?>/<? echo $i ?>.jpg"/></div>
            <?  endif;
        endfor; ?>
        </div>
    </div>
    <div class="big_w big_h m_full_w noscaleDiv"><div class="content_card">
      <button class="btn btn-black btn-full"><? echo $list['name'] ?></button>
        <div class="form-control text-area btn-white JeenSlider" disabled><div class="description_tag"><? echo $list['description'] ?></div><div><? echo $list['description'] ?></div></div>
            <div>Додано: <? echo $list['addDate'] ?></div>
            <a href="tel:<? echo $number ?>" class="btn btn-white btn-fifty btn-inline"><? echo $number ?></a>
            <a class="btn btn-white btn-fifty btn-inline">Ціна: <? echo $list['price'] ?> грн</a>
            <? if(isset($_SESSION['account']['id'])): ?>
                <? if($_SESSION['account']['status'] == $config['statusAdmin'] || $_SESSION['account']['status'] == $list['diller']): ?>
                    <div class="btn btn-black btn-fifty btn-inline" onclick="app.onclickSend('/goods/edit/<? echo $list['id']; ?>', 'deleteGoods', '', '')">Видалити</div>
                    <div class="btn btn-black btn-fifty btn-inline" onclick="app.onclickSend('/goods/edit/<? echo $list['id']; ?>', 'pushajax')">Редагувати</div>
                <?endif;?>
                <? if(!$cleave): ?>
                    <div class="btn btn-black btn-fifty btn-inline" onclick="app.onclickSend('<? echo $_SERVER['REDIRECT_URL']?>', 'cleavegoods', '', '')">Додати в корзину</div>
                <? else: ?>
                    <div class="btn btn-black btn-fifty btn-inline" onclick="app.onclickSend('<? echo $_SERVER['REDIRECT_URL']?>', 'deletecleave', '', '')">Видалити з корзини</div>
                <? endif; ?>
            <?endif;?>
                    <div class="btn btn-black btn-fifty btn-inline" onclick="shop.buyStepByStep(`<? echo $number ?>`)">Купити</div>

        </div></div>
    <script>
        var shop = new Shop();
        app.JeenLazyLoad();
    </script>


</div>
