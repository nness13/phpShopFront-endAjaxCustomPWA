(async () => {
    var getim = 0;
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');
    sizeWindow();
    const top_hero = await loadImage("materials/responsive/portfolio/top_hero_"+ getim +".jpg");
    const top_right = await loadImage("materials/responsive/portfolio/top_right_"+ getim +".jpg");
    const top_left = await loadImage("materials/responsive/default_img/mediageed.jpeg");
    const mouse = getMouse(canvas);

    var progress = 0;
    var cadr = 0;
    var page = 0;
    var limitMin = 0 + page*100;
    var limitMax = 100 + page*100;


    // var testnow = true;
    function sizeWindow() {
        if(window.innerWidth > window.innerHeight){
            getim = 'w'+window.innerWidth;
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }else {
            getim = 'h'+window.innerHeight;
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight - 70;
        }
    }

    update();
    function update() {
        sizeWindow();
        if(mouse.mousedown){
            if(mouse.slidey != null){
                //  Для 1 сторінки
                if(page == 0) {
                    if (progress + mouse.dy > limitMin) {
                        progress += mouse.dy
                    }
                }
                //  Для всіх всередині
                if(page != 0) {
                    progress += mouse.dy
                }
            }
        }else{
            if(progress > limitMin && progress < limitMax){
                if(progress < limitMin + 50){
                    if(progress - 1 >= 0){
                        progress -= 1
                    }
                }else{
                    progress += 1;
                }
            }
        }
        progress = Math.trunc(progress);
        page = Math.trunc(progress/100);
        limitMin = 0 + page*100;
        limitMax = 100 + page*100;

        if(page == 0) {
            firstPage(progress);
        }
        if(page == 1) {
            secondPage(progress - limitMin);
        }
        mouse.update();
        requestAnimationFrame(update);
    }




    function firstPage(a) {
        cadr = a;
        topHero(progress,cadr);
        whiteBackground(progress,cadr);
        topRight(progress,cadr);
        topHeroCenterMove(progress,cadr);
        topLeft(progress,cadr);
        titleText(progress,cadr);
    }

    function secondPage(a) {
        cadr = a;
        // console.log(progress,cadr);
        topHero(progress,100);
        topRightTranslate(progress,cadr);
        topHeroCenterMove(progress,100);
        topLeftTranslate(progress,cadr);
        titleText(progress,100);
    }

    function topHero(a,b) {
        cadr = b;
        // if(testnow) {
        //     console.log(top_hero.width, top_hero.height, canvas.width, canvas.height);
        //     testnow = false;
        // }

        ctx.drawImage(
            top_hero,
            0, 0, top_hero.width, top_hero.height,
            0, 0, canvas.width, canvas.height
        );
    }

    function whiteBackground(a,b) {
        cadr = b;

        ctx.fillStyle = "rgba(230, 230, 230, " + 0.0 + timeAnimate(50, 100, 50) + ")";
        ctx.fillRect(0, 0, canvas.width, canvas.height);
    }
    function topRight(a,b) {
        cadr = b;
        ctx.globalAlpha = 0.0 + timeAnimate(20, 100, 50);
        ctx.drawImage(
            top_right,
            top_right.width - timeAnimate(0, 100, 0.1), 0, top_right.width, top_right.height,
            canvas.width / 1.15 - timeAnimate(0, 100, 0.5), canvas.height / 3.5, timeAnimate(0, 100, 0.25), 300
        );
    }
    function topHeroCenterMove(a,b) {
        cadr = b;

        ctx.globalAlpha = 1;
        ctx.drawImage(
            top_hero,
            top_hero.width / 3, top_hero.height / 8, top_hero.width / 3, top_hero.height / 1.4,
            canvas.width / 3 - timeAnimate(0, 100, 5), canvas.height / 8 - timeAnimate(0, 100, 5),
            canvas.width / 3 + timeAnimate(0, 100, 2.5), canvas.height / 1.4 + timeAnimate(0, 100, 2.5)
        );
    }
    function topLeft(a,b) {
        cadr = b;
        ctx.globalAlpha = 0.0 + timeAnimate(20, 100, 50);
        ctx.drawImage(
            top_left,
            0, 0, 1 + timeAnimate(0, 100, 0.2), top_left.height,
            canvas.width / 6.5 + timeAnimate(0, 100, 100), canvas.height / 2.7,
            timeAnimate(0, 100, 0.5), 200
        );
    }
    function titleText(a,b) {
        cadr = b;

        ctx.globalAlpha = 1;
        ctx.textAlign = 'center';
        ctx.fillStyle = 'white';

        ctx.font = ' bold ' + (65 - timeAnimate(0, 80, 3)) + 'px Georgia';
        ctx.fillText('Geen Services', canvas.width / 2, canvas.height / 2.1 + timeAnimate(0, 80, 3) / 2);

        ctx.font = 20 - timeAnimate(0, 80, 8) + 'px Georgia';
        ctx.fillText('Інструмент для бізнесу', canvas.width / 2, canvas.height / 1.8 - timeAnimate(0, 80, 7));
    }
    function topRightTranslate(a,b) {
        cadr = b;
        ctx.globalAlpha = 1;
        ctx.translate(0,0 - timeAnimate(0, 100, 0.1));
        ctx.drawImage(
            top_right,
            top_right.width - timeAnimate(0, 100, 0.1), 0, top_right.width, top_right.height,
            canvas.width / 1.15 - timeAnimate(0, 100, 0.5), canvas.height / 3.5, timeAnimate(0, 100, 0.25), 300
        );
    }
    function topLeftTranslate(a,b) {
        cadr = b;
        ctx.globalAlpha = 1;
        ctx.translate(0,0 - timeAnimate(0, 100, 0.1));
        ctx.drawImage(
            top_left,
            0, 0, timeAnimate(0, 100, 0.2), top_left.height,
            canvas.width / 6.5 + timeAnimate(0, 100, 100), canvas.height / 2.7,
            timeAnimate(0, 100, 0.5), 200
        );
    }




    function timeAnimate(start, end, divisor) {
        if(cadr >= start){
            if (cadr <= end){
                return (cadr - start)/divisor;
            }else{
                return ((cadr - start)-(cadr - end))/divisor;
            }
        }else{
            return 0;
        }
    }
    function getMouse (element) {
        const mouse = {
            x: null, dx: null,
            y: null, dy: null,
            mousedown: false,
            startscrollX: 0,
            startscrollY: 0,
            tx:  null, slidex: null, stepx: null,
            ty: null, slidey: null, stepy: null,
        };
        canvas.addEventListener('mousemove', event => {
            event.preventDefault();
            const rect = element.getBoundingClientRect();

            const x = event.clientX;
            const y = event.clientY;

            mouse.dx = (mouse.x - x)/3;
            mouse.dy = (mouse.y - y)/3;

            mouse.x = x;
            mouse.y = y;
            if(mouse.mousedown){

                mouse.slidex = mouse.startscrollX - x;
                mouse.slidey = mouse.startscrollY - y;

                mouse.tx = x;
                mouse.ty = y;
            }
        });

        canvas.addEventListener('mousedown', event => {
            mouse.mousedown = true;
            mouse.startscrollX = event.clientX;
            mouse.startscrollY = event.clientY;
        });

        canvas.addEventListener('mouseup', event => {
            mouse.mousedown = false;
            mouse.startscrollX = 0;
            mouse.startscrollY = 0;
        });

        canvas.addEventListener('mouseout', event => {
            mouse.mousedown = false;
            mouse.startscrollX = 0;
            mouse.startscrollY = 0;
        });

        canvas.addEventListener('touchmove', event => {
            event.preventDefault();
            const rect = element.getBoundingClientRect();

            const x = event.touches[0].pageX;
            const y = event.touches[0].pageY;

            mouse.dx = (mouse.x - x)/3;
            mouse.dy = (mouse.y - y)/3;

            mouse.x = x;
            mouse.y = y;
            if(mouse.mousedown){

                mouse.slidex = mouse.startscrollX - x;
                mouse.slidey = mouse.startscrollY - y;

                mouse.tx = x;
                mouse.ty = y;
            }
        });
        canvas.addEventListener('touchstart', event => {
            mouse.mousedown = true;
            mouse.startscrollX = event.clientX;
            mouse.startscrollY = event.clientY;
        });

        canvas.addEventListener('touchend', event => {
            mouse.mousedown = false;
            mouse.startscrollX = 0;
            mouse.startscrollY = 0;
        });

        mouse.update = () => {
            mouse.dx = null
            mouse.dy = null
        };
        return mouse;
    }
    function loadImage(src) {
        return new Promise((resolve, reject) => {
            try {
                const image = new Image;
                image.onload = () => resolve(image);
                image.src = src;
            } catch (err) {
                return reject(err);
            }
        });
    }

    function nextAnimationFrame(callback){
        return requestAnimationFrame (callback)     ||
            function (callback) {
                setTimeout(callback, 1000/60);
            };

    };
})();