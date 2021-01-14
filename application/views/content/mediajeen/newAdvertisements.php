<div class="container" id="container">

    <link href="/public/styles/module/previewUploadImg.css" rel="stylesheet">
    <script src="/public/scripts/module/previewUploadImg.js"></script>

    <div class="triple_w big_h">
        <input type="file" form="formAdvertisements" name="img" id="inputImg" accept="image/*">
        <label for="inputImg" class="boxPreviewImg height85_card" id="inputImg-previewLabel">Натисніть щоб завантажити превью</label>

        <div class="wrapAboutStep">
            <div class="infoStep">Ваше превью - картинка яка багато говорить про вашу рекламу</div>
<!--            <button type="submit" form="formAdvertisements"  class="btn btn-primary btn-100">Далі</button>-->
        </div>

    </div>

    <div class="big_w big_h">
        <input type="file" form="formAdvertisements" class="hidden" name="video" id="inputVideo" accept="image/*">

        <label for="inputVideo" class="boxPreviewImg height85_card" id="inputVideo-previewLabel">Натисніть щоб завантажити відео</label>

        <div class="wrapAboutStep">
            <div class="infoStep">Відео - хороше інформативне відео приведе вам багато клієнтів</div>
        </div>

    </div>

    <div class="big_w big_h">
        <div class="content_card">
            <form id="formAdvertisements" name="newAdvertisements" action="/media/add" method="post" data-preloader="container"></form>
            <div class="btn-full">Налаштувати рекламу</div><br>

                <input type="text" form="formAdvertisements" class="form-control" name="name" placeholder="Імя бізнесу">

                <input type="text" form="formAdvertisements" class="form-control" name="price" placeholder="Кількість показів">

                <textarea class="form-control text-area" form="formAdvertisements" name="description" placeholder="Розкажіть клієнту про свій бізнес (необовязково)"></textarea>


            <button type="submit" form="formAdvertisements" class="btn btn-black btn-full">Додати</button>
        </div>
    </div>

</div>
