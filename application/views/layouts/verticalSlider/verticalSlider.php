<!DOCTYPE html>
<html lang="ru">
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="/public/img/favico.png" rel="icon" type="image/png">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <link href="/public/styles/layouts/verticalSlider.css" rel="stylesheet">
        <script src="/public/scripts/App.js"></script>
        <link href="/public/styles/all.css" rel="stylesheet">
        <script src="/public/scripts/layouts/verticalSlider.js"></script>

        <script>
            let app = new App(),
                slider = new verticalSlider();

        </script>

        <link rel="stylesheet" href="/public/styles/module/slick.css">
        <link rel="stylesheet" href="/public/styles/module/slick-theme.css">
        <script data-go="true" src="/public/scripts/module/slick.min.js"></script>
        <script>
            $(function () {
                $('#fullpg').slick({
                    infinite: false,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: true,
                    speed: 1000,
                    vertical: true,
                    verticalSwiping: true,
                });
            });
        </script>
    </head>
    <body>
        <div class="navBar">
            <div class="logoBox">
                <div class="topBtn"><img src="/public/img/favico.png"><div class="topBoxImgText">een</div></div>
            </div>
            <div class="navRightBox">
                <? if( !isset($_SESSION['account']['id']) ): ?>
                    <a href="/account/register" class="signUpButton">Увійти</a>
                <? else: ?>
                    <a href="/about" class="signUpButton">Мій кабінет</a>
                <? endif; ?>
            </div>
        </div>

            <?php echo $contents; ?>

    </body>
    <script>
        slider.init();
    </script>
</html>