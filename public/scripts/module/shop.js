'use strict';

class Shop {
    constructor() {
        this.component = document;
        this.container = '#container';
    }

    init() {
        this.includeJS();

    }

    includeJS(component = document) {

    }

    fullScaleGoodsImgDiv(e) {
        if ($(e).hasClass('fullScaleGoodsImgDiv')) {
            $(e).removeClass('fullScaleGoodsImgDiv');
            $(e).removeClass('noscaleDiv');
            $('#container').removeClass('overflowVisible');
            $('.JeenSlider').slick('refresh');
            if($(e).attr('id') === 'nohoverDataGoods'){
                $(e).attr('id', 'hoverDataGoods');
                $(e).attr('onclick', "");
            }
        } else {
            $(e).addClass('fullScaleGoodsImgDiv');
            $(e).addClass('noscaleDiv');
            $('.JeenSlider').slick('refresh');
            $('#container').addClass('overflowVisible');
            if($(e).attr('id') === 'hoverDataGoods'){
                $(e).attr('id', 'nohoverDataGoods');
                setTimeout(function () {
                    $(e).attr('onclick', "shop.fullScaleGoodsImgDiv(this)");
                }, 10)
            }
        }
    }

    buyStepByStep(num){
        Swal.fire(`<div>Телефонуйте:  <a href="tel:${num}">${num}<a/></div>`)
      //   Swal.mixin({
      //       confirmButtonText: 'Далі &rarr;',
      //
      //       showCancelButton: true,
      //       progressSteps: ['1', '2']
      //   }).queue([
      //       {
      //           title: 'Контакт',
      //           text: 'Вкажіть номер телефону для звязку з вами',
      //           input: 'text',
      //       },
      //       {
      //           title: 'Доставка',
      //           html: `<div>Тут ви можете вказати дані для доставки новою поштою</div>
      //                   <ul>
      //                       <li>Прізвище Імя по Батькові</li>
      //                       <li>Місто</li>
      //                       <li>Відділення</li>
      //                   </ul>`,
      //           input: 'textarea',
      //       }
      //   ]).then((result) => {
      //       if (result.value) {
      //           const answers = JSON.stringify(result.value)
      //           Swal.fire({
      //               title: 'All done!',
      //               html: `
      //   Your answers:
      //   <pre><code>${answers}</code></pre>
      // `,
      //               confirmButtonText: 'Lovely!'
      //           })
      //       }
      //   })
    }
}