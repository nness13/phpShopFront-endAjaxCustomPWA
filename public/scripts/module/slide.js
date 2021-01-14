$(document).ready(function () {
    startJeenSlider();
});

function startJeenSlider() {
    let allSliders = document.querySelectorAll('.wrapJeenSlider');
    allSliders.forEach(e => {
        widthToLine(e);
        listeners(e);
    });

}

function widthToLine(element) {
    var
        line = element.querySelector(".JeenSlider"),
        elementChildrens = line.children,
        // widthEl = element.offsetWidth,
        fullwidth = 0;
    for (var i=0, child; child=elementChildrens[i]; i++) {
        // child.style.width = widthEl + 'px';
        console.log(child.offsetWidth);
        fullwidth += child.offsetWidth;

    }
    line.style.width = fullwidth + 'px';
    console.log(line.clientWidth);

}
function listeners (element) {
    const mouse = {
        x: null, y: null,
        mousedown: false,
        startscrollX: 0,
        startscrollY: 0,
        slidex: null, slidey: null,
    };


    element.addEventListener('mousemove', event => {
        const x = event.clientX;
        const y = event.clientY;

        mouse.x = x;
        mouse.y = y;
        if(mouse.mousedown){
            mouse.slidex = mouse.startscrollX - x;
            mouse.slidey = mouse.startscrollY - y;
            sliding()
        }
    });

    element.addEventListener('mousedown', event => {
        mouse.mousedown = true;
        mouse.startscrollX = event.clientX;
        mouse.startscrollY = event.clientY;
    });

    element.addEventListener('mouseup', event => {
        mouse.mousedown = false;
        mouse.startscrollX = 0;
        mouse.startscrollY = 0;
    });

    element.addEventListener('mouseout', event => {
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


function sliding(e) {




}