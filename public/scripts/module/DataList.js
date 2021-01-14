class DataList {
    constructor(inputId) {
        this.inputId = inputId;
        this.getOptions('getcounties')
            .then(data => {
                this.options = data;
                
            }).catch(
                error => {
                console.error(error);
            });
        $(inputId).after(`<ul class="datalist-ul"></ul>`);
        const style = document.createElement('style');
        style.textContent = `
            .datalist-ul{
                width: ${$(inputId).outerWidth()}px
            }
        `;
        document.body.appendChild(style);
    }

     async getOptions(api) {
         return new Promise(function (resolve, reject) {
             let data = {
                     'get':api,
                     'namespace':'specialspace1'
                 },
                 url = '/api/'+api,
                 json = null;

             $.ajax({
                 type: 'POST',
                 url: url,
                 data: data,
                 success: function(result) {
                     json = jQuery.parseJSON(result);
                     resolve (json.data);
                 },
                 error: function () {
                     reject ('Дані не прийшли');
                 }
             });
         });
    }

    create(filter = "") {
        const list = $(filter).next();
        const filterOptions = this.options.village.filter(
            d => filter.value === "" || d.village.toUpperCase().indexOf(filter.value.toUpperCase()) === 0
        );

        if (filterOptions.length === 0) {
            list.removeClass("active");
        } else {
            list.addClass("active");
        }

        list.html(filterOptions.slice(0, 100).sort(function(a, b){return a.village.length - b.village.length ;}).map(o => `<li id=${o.id}><span>${o.village.slice(0, o.village.toUpperCase().indexOf(filter.value.toUpperCase()) + filter.value.length)}</span>${o.village.slice(o.village.toUpperCase().indexOf(filter.value.toUpperCase()) + filter.value.length)}, ${this.options.region[o.region]} область</li>`).join(""));
    }

    addListeners(datalist) {
        const input = $(this.inputId);
        const list = input.next();
        input.attr('autocomplete', "off");

        input.on("input", function(e) {
            datalist.create(e.target);
        });
        input.on("blur", function(e) {
            setTimeout(function() {
                const activeList = $(e.target).next();
                if(activeList.hasClass('active')){
                    activeList.removeClass('active');
                }
            },200);

        });
        list.on("click", function(e) {
            $(e.target).parent().prev().val(e.target.innerText);
            list.removeClass("active");
        });
    }

}