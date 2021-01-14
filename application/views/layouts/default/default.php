<!DOCTYPE html>
<html lang="ru">
    <head>
        <title><?php echo $title; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no"">

        <link href="https://fonts.googleapis.com/css?family=Roboto:900|Sarabun:200,400,800" rel="stylesheet">
        <link rel="stylesheet" href="/public/styles/module/fontawesome.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link href="/public/img/favico.png" rel="icon" type="image/png">

        <script src="/public/scripts/module/jquery.min.js"></script>

        <link href="/public/styles/module/preloader.css" rel="stylesheet">
        <link href="/public/styles/layouts/default.css" rel="stylesheet">
        <link href="/public/styles/content/contentDefault.css" rel="stylesheet">
        <link href="/public/styles/module/menu.css" rel="stylesheet">
        <link href="/public/styles/all.css" rel="stylesheet">

        <script src="/public/scripts/layouts/DefaultLayout.js"></script>
        <script src="/public/scripts/content/LeftPanel.js"></script>

        <link href="/public/styles/module/sweetalert2.min.css" rel="stylesheet">
        <script src="/public/scripts/module/sweetalert2.all.min.js"></script>

        <script src="/public/scripts/App.js"></script>
        <script>
            var app = new App();
            var defaultLayout = new DefaultLayout({
                component: '#container'
            });
            var leftPanel = new LeftPanel();
        </script>
    </head>
    <body id="body">

        <div id="thismap">
            <div id="map">
                <? echo $pathmap ?>
            </div>
            <div class="searchDiv">
                <input type="text" name="searchInp" id="searchInputId" class="searchInput" onfocus="defaultLayout.focusInputSearch()" onblur="defaultLayout.blurInputSearch()">
                <div class="lineLupe"></div>
            </div>
        </div>
        <div id="abroad"></div>
        <?php echo $contents; ?>

        <script>
            app.init();
            defaultLayout.init();
            leftPanel.init();
        </script>
    </body>

</html>