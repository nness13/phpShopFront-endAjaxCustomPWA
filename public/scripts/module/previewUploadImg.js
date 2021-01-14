'use strict';

class UploadImg {
    constructor() {
        this.component = document;
        this.container = '#container';
        this.defaultOneDiv = 'Натисніть щоб завантажити фото';
        this.label = '<label for="<? echo $i ?>">Натисніть щоб завантажити фото</label>'
    }

    init() {
        $('.oneImgInput').on('change', function (){
            uploadImg.oneFilePreview(this)
        });
        $('#imgInputAddit').on('change', function (){
                uploadImg.multipleFilePreview(this)
        });
        $("i.imgOptionMenu").on('click', this.imgOptionMenu);
    }

    imgOptionMenu(){
        const thisTargetNum = $(this).parent().parent().attr("numm");
        // app.onclickSend(window.location.pathname, 'deleteAdditImg', '&data='+thisTargetNum, '');

        console.log(thisTargetNum);
    }

    oneFilePreview(thisinput) {
        let inputid = '#' + $(thisinput).attr('id'),
            input = $(thisinput)[0],
            name = inputid + "-previewLabel",
            reader;
        if (input.files && input.files[0]) {
            if (input.files[0].type.match('image.*')) {
                reader = new FileReader();
                reader.onload = function (e) {
                    $(name).html("<div class=\"imgUploadTools\"><a id=\"closeImgUpload\" onclick=\"uploadImg.closeImg('" + name + "', '" + inputid.slice(1) + "')\"><i class=\"fas fa-times centerItem\"></i></a></div><img class=\"uploadImg noscaleImg\" id=\"img-preview\" src=\"" + e.target.result + "\" />")
                    $(name).removeAttr('for');
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                console.log('ошибка, не изображение');
            }
        } else {
            console.log('хьюстон у нас проблема');
        }
    }

    multipleFilePreview(thisinput) {
        let defaultBox = "<label for='imgInputAddit' class='divImgUploadCard' id='img-previewDivAddit' title='Додати більше зображень товару'><i class='uploadImg noscaleImg fas fa-images centerItem'></i></label>",
            input = $(thisinput)[0],
            countFT = input.files,
            reader;
        $('#divImgUploadAddit').html(defaultBox);
        if (countFT.length > 5) {
            return swal.fire('Не більше 5 зображень');
        }

        if (countFT && countFT[0]) {
            for (let i = 0; i < countFT.length; i++) {
                if (countFT[i].type.match('image.*')) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        $('#divImgUploadAddit').append("<div class='divImgUploadCard'><img class='uploadImg noscaleImg' id='img-previewAddit" + i + "' src='" + e.target.result + "' /></div>")
                    };
                    reader.readAsDataURL(countFT[i]);
                } else {
                    console.log('ошибка, не изображение');
                }
            }
        } else {
            console.log('хьюстон у нас проблема');
        }
    }

    closeImg(div, fo) {
        $(div).text(this.defaultOneDiv);
        $(div).attr('for', fo);
    }
}