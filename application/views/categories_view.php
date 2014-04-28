<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script src="http://notifyjs.com/dist/notify-combined.min.js"></script>
        <!-- page specific -->
        <style>
            @font-face {
                font-family: 'Kirsty';
                src: url('<?php echo site_url('assets/fonts/Kirsty.ttf') ?>');
            }
        </style>
        <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/agnostic.css') ?>">
        <link rel="stylesheet" id="style-regular-colours" type="text/css" href="<?php echo site_url('assets/css/regular-colours.css') ?>">
        <link rel="stylesheet" id="style-high-contrast-colours" type="text/css" href="<?php echo site_url('assets/css/high-contrast-colours.css') ?>">
        <link rel="stylesheet" id="style-larger-fonts" type="text/css" href="<?php echo site_url('assets/css/larger-fonts.css') ?>">
        <script src="<?php echo site_url('assets/js/common.js') ?>"></script>
        <script src="<?php echo site_url('assets/js/categories_script.js') ?>"></script>
        <title>Cheffy</title>
    </head>
    <body>
        <div class="accessibility-controls">
            <div class="container">
                Accessibility Help:
                <a id="high-contrast" href="">High Contrast</a>
                <a id="large-font" href="">Larger Font</a>
            </div>
        </div>
        <div class="jumbotron">
            <div class="container">
                <h1>Cheffy</h1>
                <p>A food website</p>
            </div>
        </div>
        <div id="carousels">
        </div>
        <hr class="featurette-divider">
        <div class="container">
            <hr class="featurette-divider">
            <footer>
                <p>Copyright Cheffy 2014</p>
            </footer>
        </div>
    </body>

</html>