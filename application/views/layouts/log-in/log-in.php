<!DOCTYPE html>
<html lang="ru">
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link href="/public/img/favico.png" rel="icon" type="image/png">

        <link href="/public/styles/layouts/log-in.css" rel="stylesheet">
        <link href="/public/styles/all.css" rel="stylesheet">
        <link href="/public/styles/module/flip-card.css" rel="stylesheet">
        <script src="/public/scripts/module/flip-card.js"></script>

        <link href="/public/styles/module/sweetalert2.min.css" rel="stylesheet">
        <script src="/public/scripts/module/sweetalert2.all.min.js"></script>

        <script src="/public/scripts/App.js"></script>
        <script>
            var app = new App();
        </script>
    </head>
    <body>
        <div class="layout layout-menu">    
            <div class="nav-menu centerMobile">
                <div class="topBtn"><img src="/public/img/favico.png"><div class="topBoxImgText">inn</div></div>
            </div>
        </div>

        <?php echo $contents; ?>

        <script>
            app.init();
        </script>
    </body>
</html>