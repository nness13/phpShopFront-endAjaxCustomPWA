$(document).ready(function () {
    turnAround();
});

function turnAround() {
    $('.plusOptionIDhover').hover(function() {
        $('.sf-wrap').addClass('hover');
    }, function() {
        $('.sf-wrap').removeClass('hover');
    })
$('.plusOptionIDactive').click(function(event) {
            $('.sf-wrap').toggleClass('active');
    });
}