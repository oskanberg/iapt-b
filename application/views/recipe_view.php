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
        <script src="<?php echo site_url('assets/js/recipe_script.js') ?>"></script>
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
                <ol class="breadcrumb">
                    <li><a href="<?php echo site_url('/') ?>">Home</a></li>
                    <li class="active"></li>
                </ol>
            </div>
        </div>
        <div class="container">
            <ul class="nav nav-pills">
                <li class="title">
                    <a href="" data-toggle="modal" data-target=".format-explain-modal">Recipe Format: <span class="glyphicon glyphicon-question-sign"><span>
                    </a>
                </li>
                <li class="active">
                    <a class="fmt" href="#">Narrative</a>
                </li>
                <li>
                    <a class="fmt" href="#">Segmented</a>
                </li>
                <li>
                    <a class="fmt" href="#">Step By Step</a>
                </li>
            </ul>
        </div>
        <div class="container light-bg rounded-corners outer-shadow padded">
            <h1 id="recipe-name"></h1>
            <hr class="featurette-divider">
            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">Ingredients</h2>
                    <ul id="ingredients-list" class="list-group">
                    </ul>
                </div>
                <div class="col-md-5">
                    <div class="recipe-img-crop">
                        <img class="featurette-image img-responsive" src="http://placehold.it/400x400" alt="Generic placeholder image">
                    </div>
                </div>
            </div>
        </div>
        <div id="method">
        </div>
        <hr class="featurette-divider">
        <div class="container">
            <hr class="featurette-divider">
            <footer>
                <p>Copyright Cheffy 2014</p>
            </footer>
        </div>

        <!-- modal window -->
        <div class="modal fade format-explain-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" aria-describedby="Explanation of the different recipe formats">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Recipe Formats Explained</h4>
                </div>
                <div class="modal-body">
                    <p>Select the recipe format that best suits your cooking style:</p>
                    <div class="row">
                        <div class="col-md-4">
                            <h2>Step By Step</h2>
                            <p>In this format the recipe is split into small steps. The steps include all pre-preparation steps.</p>
                            <p><a class="btn btn-default" onClick="click_format_button('Step By Step');" data-dismiss="modal" href="#" role="button">Select Format &raquo;</a></p>
                        </div>
                        <div class="col-md-4">
                            <h2>Segmented</h2>
                            <p>In this format the recipe is segmented into easy-to-follow steps, but avoids including pre-preparation steps.</p>
                            <p><a class="btn btn-default" onClick="click_format_button('Segmented');" data-dismiss="modal" href="#" role="button">Select Format &raquo;</a></p>
                        </div>
                        <div class="col-md-4">
                            <h2>Narrative</h2>
                            <p>This is the style conventionally found in books. The recipe is presented in one go as a narrative.</p>
                            <p><a class="btn btn-default" onClick="click_format_button('Narrative');" data-dismiss="modal" href="#" role="button">Select Format &raquo;</a></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
          </div>
        </div>

    </body>

</html>