<!doctype html>
<html lang="ru">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!--meta http-equiv="cleartype" content="on"/-->

    <title><? echo $title ?></title>

    <meta name="twitter:card" content="summary_large_image" />

    <meta property="og:type" content="website" />
    <meta property="og:image:type" content="image/png" />

    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width" />
    <meta name="apple-mobile-web-app-capable" content="yes" />

    <link rel="icon" href="/public/img/favico.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">

    <style>

        body {background-color:#353330;}
        #PreloaderCon,
        .AppBase {display:none;}

    </style>

    <script src="public/scripts/webfont.js"></script>
    <script type="text/javascript">
        window.APPLICATION_CSS = "/public/styles/application.min.css";
    </script>
    <script src="public/scripts/fallback/detection.js"></script>



</head>


<body id="body">

<?php //echo $content; ?>
<div id="loadcontent" loader="application/config/data.json"></div>

<div id="PreloaderCon">

    <div class="logoSvgCon">
        <svg id="logoPath" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 200" xml:space="preserve">
					<path fill="none" stroke-width="7" stroke-miterlimit="10" d="M4,47.3c-0.1-1.6,2.4-2.8,5.8-4.2c0.2,0,0.3-0.1,0.4-0.1c12.8-4,25.9-6.3,37.7-6.3c2.1,0,4.1,0.1,6,0.2c17.4,1.3,29.8,8,35.8,20.1c1.4,4,2.2,8.3,2.1,12.5C91.7,79.5,86.5,86.7,81,94l-4.5,5.4c-2.9,3.1-6.1,6.3-8.9,8.9c-7.3,6.9-13.4,9.9-19.6,9.9c-0.9,0-1.8-0.1-2.7-0.2c-8.1-1.2-12.9-9.7-13.5-17.5c-0.6-8,2.5-17.1,10.9-19.5c1.8-0.5,3.6-0.8,5.4-0.8c5.5,0,11.3,2.3,18.2,7.2c3.9,2.8,7.1,5.1,10,7.5l5.1,4.3c7.7,7.8,12.4,14,13.6,23c0.6,4.2,0.3,8.6-0.7,13C90,147.8,78.9,156.4,62.4,160c-6,1.3-13.2,2-20.6,2l0,0c-7.5,0-14.5-0.7-22.1-2c-0.1,0-0.3,0-0.4-0.1c-3.6-1-6.1-1.8-6.2-3.5l-9-108L4,47.3z"/>
				</svg>

        <svg id="logoOutroPath" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 140" enable-background="new 0 0 100 140" xml:space="preserve">
					<path fill-rule="evenodd" clip-rule="evenodd" fill="none" stroke-width="7" stroke-miterlimit="10" d="M100,132.5H41.7c-7.5,0-14.5-0.9-22.1-2.2c-0.1,0-0.3-0.1-0.4-0.1c-3.6-1-6.1-1.8-6.2-3.5L4,17.3c-0.1-1.6,2.4-2.9,5.8-4.2c0.2,0,0.3-0.1,0.4-0.1c12.8-4,25.9-6.3,37.7-6.3c2.1,0,4.1,0.1,6,0.2c17.4,1.3,29.8,8,35.8,20.1c1.4,4,2.2,8.3,2.1,12.5C91.7,49.5,86.5,56.7,81,64l-4.5,5.4c-2.9,3.1-6.1,6.3-8.9,8.9c-7.3,6.9-13.4,9.9-19.6,9.9c-0.9,0-1.8-0.1-2.7-0.2c-8.1-1.2-12.9-9.7-13.5-17.5c-0.6-8,2.5-17.1,10.9-19.5c1.8-0.5,3.6-0.8,5.4-0.8c5.5,0,11.3,2.3,18.2,7.2c3.9,2.8,7.4,5.3,10.3,7.7"/>
				</svg>


    </div>

    <div id="logoLine"></div>

</div>



<div class="AppBase">


    <div class="app" id="app">

        <div id="swipeConLayers">
            <div id="swipeConHTMLLayer">
            </div>
        </div>

        <div id="navigation">
            <ul class="topnav">
                <li class="logo" id="logoLink">
                    <div class="black"></div>
                    <div class="white"></div>
                    <a href="#app">Піднятись вгору</a>
                </li>
                <?php if (isset($_SESSION['account']['id'])): ?>
                    <li class="signup_bn"><a id="signupButton" href="/account/settings">Мій кабінет</a></li>
                <?php else:?>
                    <li class="signup_bn"><a href="/account/login" id="signupButton">Увійти</a></li>
                    <li class="login_bn"><a href='/account/register' alt="Login" target="_self">Зареєструватись</a></li>

                <?php endif; ?>
            </ul>
            <ul class="sidenav" id="sidenav">
            </ul>
        </div>



        <div id="footer">

            <div class="features">
                <ul>
                    <li id="feature_title">
                        <h2>Створи свій власний<br>Великий Проект Зараз</h2>
                    </li>
                    <li id="feature1" class="free">
                        <p>Спробуй <br>Geed <strong>безплатно</strong></p>
                    </li>
                    <li id="feature2" class="proposals">
                        <p><strong>Та оптимізуй </strong> <br>свій бізнес</p>
                    </li>
                    <li id="feature3" class="monthly">
                        <p>Вибери умови<strong> індивідуально<br> до своїх потреб</strong></p>
                    </li>

                </ul>
            </div>


            <div class="signup" id="signup">
                <h3>
                    Увійди та спробуй наш сервіс
                    <small class="signup-info">Якщо у вас ще не має облікового запису Geed, просто <a href='/account/register' alt="sign in">ДОДАЙ</a></small>
                    <small class="signup-info">Та завантажуй наш додаток <a href='/public/materials/geed_relise.apk' alt="sign in">Андроїд</a></small>
                </h3>

                <div class="social_links">
                    <a href="https://www.instagram.com/andriy__n/?hl=ru" target="_blank">Instagram</a>
                    <a href="http://ideigo.com" target="_blank">Blog</a>
                    <a href="#" target="_blank">Вакансії</a>

                    <a href="#" target="_blank">FAQ</a>
                    <a href="http://geed.tk/privacy/" target="_blank">Privacy</a>
                </div>


                <span class="footer_logo" id="footer_logo"></span>
            </div>


        </div>
    </div>
</div>

<div class="landscapelock">
</div>


</body>