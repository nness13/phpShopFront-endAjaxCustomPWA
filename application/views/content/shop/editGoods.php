<div class="container" id="container">
    <link rel="stylesheet" href="/public/styles/module/slick.css">
    <link rel="stylesheet" href="/public/styles/module/slick-theme.css">
    <script data-go="true" src="/public/scripts/module/slick.min.js"></script>
    <link href="/public/styles/module/previewUploadImg.css" rel="stylesheet">
    <script src="/public/scripts/module/previewUploadImg.js"></script>

    <script>
        $(function () {
            $('.JeenSlider').slick({
                arrows: false,
                slidesToShow: 1,
                dots: true,
            });
        });
        var uploadImg = new UploadImg();
    </script>

    <div class="triple_w big_h m_full_w m_4_h">
        <? for ($i = 0; $i <= 4; $i++): ?>
            <input type="file" form="formGoodsEdit" class="oneImgInput" name="<? echo $i ?>" id="<? echo $i ?>" accept="image/*">
        <? endfor; ?>

        <form id="formGoodsEdit" name="formGoodsEdit" action="/goods/edit/<? echo $list['id'] ?>" method="post" data-preloader="container"></form>
        <div class="JeenSlider">
            <? for ($i = 0; $i <= 4; $i++): ?>
                <div class="slick-img parrentGoods" numm="<? echo $i ?>" id="parrent<? echo $i ?>Goods" <? if($isjpg = file_exists("materials/responsive/goods/".$list['id']."/$i.jpg")): ?>idslideImg<? endif; ?>">
                    <? if($isjpg): ?>
                        <div class="slick-img">
                            <img class="slick-img noscaleImg" src="/materials/responsive/goods/<? echo $list['id'] ?>/<? echo $i ?>.jpg"/>
                            <i class='fas fa-ellipsis-v centerItem primary imgOptionMenu'></i>
                        </div>
                        <label class="labelUpload" for="<? echo $i ?>" id="<? echo $i ?>-previewLabel"></label>
                    <? else: ?>
                        <label class="labelUpload firstUpload firstUploadEditV" for="<? echo $i ?>" id="<? echo $i ?>-previewLabel">Натисніть щоб завантажити фото</label>

                    <? endif; ?>
                </div>
            <? endfor; ?>
        </div>

    </div>

    <div class="big_w big_h m_full_w">
        <div class="content_card">
            <div class="btn-full">Налаштувати товар</div><br>

            <input type="text" form="formGoodsEdit" class="form-control" name="name" placeholder="Назва" value="<? echo $list['name'] ?>">

            <input type="text" form="formGoodsEdit" class="form-control" name="price" placeholder="Ціна" value="<? echo $list['price'] ?>">

            <textarea class="form-control text-area" form="formGoodsEdit" name="description" placeholder="Розкажіть клієнту про товар"><? echo $list['description'] ?></textarea>
            <div class="posRel">
                <div class="btn-full">
                    <i class="primary fas fa-folder-plus centerItem inputPlusI" id="category-butt"></i>
                    <div class="inputTags" id="inputTags"></div>
                    <input class="form-control" id="category" value="Обери категорію товару" disabled>
                </div>
            </div>
            <div class="posRel">
                <input type="text" form="formGoodsEdit" class="form-control" name="options" placeholder="Опції">
            </div>
            <input type="checkbox" form="formGoodsEdit" name="dropshop" class="inputswitch" id="switch" /><label for="switch" class="labelswitch"><span class="spann"><a>Оптом</a></span></label>

            <button class="btn btn-black btn-fifty btn-inline" onclick="onclickSend('/goods/edit/<? echo $list['id']; ?>', 'deleteGoods', '', '')">Видалити</button><button form="formGoodsEdit" type="submit" class="btn btn-black btn-fifty btn-inline">Зберегти</button>
        </div>
    </div>


    <script>
        defaultLayout.selectCategory();
        uploadImg.init();
    </script>
</div>