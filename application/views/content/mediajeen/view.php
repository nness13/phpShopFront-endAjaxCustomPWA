<div class="container" id="container">
    <link rel="stylesheet" href="/public/styles/module/slick.css">
    <link rel="stylesheet" href="/public/styles/module/slide.css">
    <link rel="stylesheet" href="/public/styles/module/slick-theme.css">
    <link rel="stylesheet" href="/public/styles/module/plyr.css">

    <script data-go="true" src="/public/scripts/module/slick.min.js"></script>
    <script>
        $('.JeenSlider').slick({
            arrows: false,
            slidesToShow: 1
        });
    </script>
    <script data-go="true" src="/public/scripts/module/plyr.js"></script>
<!--    <script data-go="true" src="/public/scripts/module/moment.js"></script>-->
    <script>
        var player = new Plyr('#player', {
            autoplay: true,
        });
    </script>


    <div class="triple_w big_h m_full_w m_4_h noscaleDiv">

        <div class="JeenSlider">
            <video class="slick-img" id="player" src="/materials/responsive/video/videoplayback.mp4"></video>
        </div>
    </div>

</div>