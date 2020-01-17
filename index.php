<!DOCTYPE html>
<html>
<head>
    <title>ITGlossary</title>
    <link rel="shortcut icon" type="image/png" href="app.png">
    <link rel="stylesheet" href="css/personal.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- Chrome -->
    <meta name="theme-color" content="#1976D2">
    <link rel="manifest" href="manifest.json">
    <!-- Safari -->
    <link rel="apple-touch-icon" href="app.png">
    <meta name="apple-mobile-web-app-title" content="Glossary">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="theme-color" content="#1976D2">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
<div class="containe">
    <div class="row left-align">
        <form class="col s12 center-align">
            <div class="row">
                <div class="col l0"></div>
                <h2 class="left-align blue-text text-darken-2">ITGlossary</h2>
                <div class="input-field col s11">
                    <i class="material-icons prefix">library_books</i>
                    <input type="text" id="autocomplete-input" class="autocomplete">
                    <label for="autocomplete-input">Type to search</label>
                </div>
            </div>
        </form>
        <ul class="collection with-header">
            <li class="collection-header">
                <h4 id="name">Welcome!</h4>
                <button class="btn waves-effect waves-light waves-light blue darken-3" onclick="playAudio()"
                        type="button" name="action" id="audioButton" style="display:none;">
                    <i class="material-icons right">record_voice_over</i>
                </button>
                <audio id="audio">
                    <source type="audio/mpeg">
                </audio>
            </li>
            <li class="collection-item" id="def">
                Hi, this is a digital glossary of computer science words.<br>
                We have created this web application to collect all the terms that we programmers use in everyday
                life.<br>
		Using this app, people who are not pratical with the technology field can learn new words concearning computer science.<br>
                An interesting feature is that you can pick a word totally at random. This
                mode can be used by clicking the blue button in the right bottom corner.<br>
                Enjoy the application and make good use of it!<br>
                <h5>4Ai (a part of it)</h5>
            </li>
        </ul>
    </div>
</div>
<footer class="page-footer" style="position:fixed;bottom:0;left:0;width:100%;background-color:rgba(255,255,255,0);">
    <div class="footer-copyright" style="background-color:rgba(255,255,255,0)">
        <div class="container s12 right-align">
            <button id="random" class="btn-floating btn-large waves-effect waves-light blue darken-3 tooltipped"
                    type="submit" name="action" data-position="left" data-tooltip="Random word">
                <i class="material-icons right">autorenew</i>
            </button>
        </div>
    </div>
</footer>
<script type="text/javascript" src="js/materialize.min.js"></script>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script> -->
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
