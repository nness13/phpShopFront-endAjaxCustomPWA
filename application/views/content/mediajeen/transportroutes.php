<div class="container" id="container">

    <?php if (isset($list)): ?>
        <? foreach ($list as $key => $val): ?>
            <div class="big_w small_h" id="hoverDataGoods">
                <img class="containerdivimg" src="/materials/responsive/transport_routes/<? echo $val['userid'] ?>/<? echo $val['img'] ?>"/>

                <div class="dataGoods">
                    <div class="btn btn-full white dataGoodsItem"><? echo $val['route'] ?></div>
                    <a href="https://www.google.com.ua/maps/dir/%D0%9D%D0%B8%D0%B6%D0%B0%D0%BD%D0%BA%D0%BE%D0%B2%D0%B8%D1%87%D0%B8,+%D0%9B%D1%8C%D0%B2%D0%BE%D0%B2%D1%81%D0%BA%D0%B0%D1%8F+%D0%BE%D0%B1%D0%BB%D0%B0%D1%81%D1%82%D1%8C/%D0%9B%D1%8C%D0%B2%D0%BE%D0%B2,+%D0%9B%D1%8C%D0%B2%D0%BE%D0%B2%D1%81%D0%BA%D0%B0%D1%8F+%D0%BE%D0%B1%D0%BB%D0%B0%D1%81%D1%82%D1%8C,+79000/@49.6426612,22.8433355,9z/data=!3m1!4b1!4m14!4m13!1m5!1m1!1s0x473b83171a75af87:0x9115a7f5dd81006f!2m2!1d22.8068436!2d49.6770742!1m5!1m1!1s0x473add7c09109a57:0x4223c517012378e2!2m2!1d24.029717!2d49.839683!3e3?hl=ru" target="_blank" class="btn btn-full btn-primary white dataGoodsItem">Відкрити на карті</a>

                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <script>
        app.pagination();
    </script>

</div>
