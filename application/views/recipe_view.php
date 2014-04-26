<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <!-- page specific -->
        <link rel="stylesheet" type="text/css" href="categories.css">
        <script src="recipe_script.js"></script>
        <title>Cheffy</title>
    </head>

    <body>
        <div class="accessibility-controls">
            <div class="container">
                <a href="#">Controls</a>
            </div>
        </div>
        <div class="jumbotron">
            <div class="container light-bg">
                <h1>Cheffy</h1>
                <p>A food website</p>
            </div>
        </div>
        <div class="container">
            <ul class="nav nav-pills">
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
                    <img class="featurette-image img-responsive" src="http://placehold.it/400x400" alt="Generic placeholder image">
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
    </body>

</html>