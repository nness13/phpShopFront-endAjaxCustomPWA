<!DOCTYPE html>
<html lang="ru">
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="/public/img/favicon.png" rel="icon" type="image/png">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <link href="/public/styles/layouts/portfolio.css" rel="stylesheet">

        <link href="/public/styles/module/sweetalert2.min.css" rel="stylesheet">
        <script src="/public/scripts/module/sweetalert2.all.min.js"></script>

        <script src="/public/scripts/all.js"></script>
        <link href="/public/styles/all.css" rel="stylesheet">
    </head>
    <body>
        <div class="navBar">
            <div class="logoBox">
                <div class="topBtn"><img src="/public/img/favicon.png"><div class="topBoxImgText">een</div></div>
            </div>
            <div class="navRightBox">
                <? if( !isset($_SESSION['account']['id']) ): ?>
                    <a href="/account/register" class="signUpButton">Увійти</a>
                <? else: ?>
                    <a href="/about" class="signUpButton">Мій кабінет</a>
                <? endif; ?>
            </div>
        </div>

        <canvas class="canvas" id="canvas"></canvas>
<!--        --><?php //echo $contents; ?>
    </body>
    <script src="/public/scripts/layouts/portfolioApp.js"></script>

</html>