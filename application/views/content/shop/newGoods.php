<div class="container" id="container">

    <link href="/public/styles/module/previewUploadImg.css" rel="stylesheet">
    <script src="/public/scripts/module/previewUploadImg.js"></script>
    <script>
        var uploadImg = new UploadImg();
    </script>

    <div class="triple_w big_h m_full_w m_5_h noscaleDiv">
        <input type="file" form="formGoods" name="img" class="oneImgInput" id="inputImg" accept="image/*">
        <label class="labelUpload firstUpload" for="inputImg" id="inputImg-previewLabel">Натисніть щоб завантажити фото</label>
        <div class="divImgUploadAddit" id="divImgUploadAddit">
            <label for='imgInputAddit' class='divImgUploadCard' id='img-previewDivAddit' title='Додати більше зображень товару'><i class='uploadImg noscaleImg fas fa-images centerItem'></i></label>
        </div>
        <input type="file" form="formGoods" name="imgAddit[]" id="imgInputAddit" accept="image/*" multiple>

    </div>

    <div class="big_w big_h m_full_w">
        <div class="content_card">
            <form id="formGoods" name="newGoods" action="/new/goods" method="post" data-preloader="container"></form>
            <div class="btn-full m_b_10">Налаштувати товар</div>

                <input type="text" form="formGoods" class="form-control" name="name" placeholder="Назва">

                <input type="text" form="formGoods" class="form-control" name="price" placeholder="Ціна">

                <textarea class="form-control descriptionTextarea" form="formGoods" name="description" placeholder="Розкажіть клієнту про товар"></textarea>
            <div class="posRel">
                <div class="btn-full">
                    <i class="primary fas fa-folder-plus centerItem inputPlusI" id="category-butt"></i>
                    <div class="inputTags" id="inputTags"></div>
                    <input class="form-control" id="category" value="Обери категорію товару" disabled>
                </div>
            </div>
            <div class="posRel">
                <input type="text" form="formGoods" class="form-control" name="options" placeholder="Опції">
            </div>
            <input type="checkbox" form="formGoods" name="dropshop" class="inputswitch" id="switch" /><label for="switch" class="labelswitch"><span class="spann"><a>Оптом</a></span></label>

            <button type="submit" form="formGoods" class="btn btn-black btn-full">Додати</button>
        </div>
    </div>
    <div class="big_w h4 m_full_w">
        <input type="file" form="formGoods" class="hidden" name="video" id="inputVideo" accept="image/*" multiple>

        <label class="labelUpload firstUpload" for="inputVideo" id="inputVideo-previewLabel">Натисніть щоб завантажити фото</label>

    </div>
<? if($_SESSION['account']['status'] == 3): ?>
    <div class="big_w h2 m_full_w">
            <div class="content_card">
                <input type="text" class="form-control" name="newCategory" id="newCategory" placeholder="Запропонуй свою категорію...">
            </div>
    </div>
<? endif; ?>

    <script>
        defaultLayout.selectCategory();
        uploadImg.init();
    </script>

</div>
