<div class="container" id="container">

    <?php if (isset($list)): ?>
        <? foreach ($list as $key => $val): ?>
            <div class="small_w small_h m_fifty_w" id="hoverDataGoods">
                <img class="containerdivimg" src="/materials/responsive/default_img/90OK.gif" lazyLoad="/materials/responsive/goods/<? echo $val['id'] ?>/0.jpg"/>

                <a href="/goods/<? echo $val['id'] ?>" id="pushajax" data-type="pushajax" class="dataGoods">
                    <div class="btn btn-full white dataGoodsItem"><? echo $val['name'] ?></div>
                    <div class="btn btn-full white dataGoodsItem">
                            <div class="white"><? echo $val['price'] ?> грн</div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <script>
        app.pagination();
        app.JeenLazyLoad();
    </script>

</div>
