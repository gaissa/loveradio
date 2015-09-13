<!DOCTYPE html>

<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="gaissa">
    <!--<link rel="icon" href="http://getbootstrap.com/favicon.ico">-->

    <title> /_ ( ) \ / /, _ </title>

     <!-- CSS -->
    <link href='https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz' rel='stylesheet' type='text/css'>

     <!-- CSS -->
    <!--<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">-->

    <!-- Bootstrap core CSS -->
    <link href="./lib/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./lib/css/light.css" rel="stylesheet">
    <link href="./lib/css/custom.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <style type="text/css"></style><script src="./lib/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body cz-shortcut-listen="true">

    <audio id="music" preload="none">
        <source src="http://hear.fi:8000/love.mp3">
    </audio>

    <div id="audioplayer">
        <button id="pButton" class="play"></button>
        <div id="max"></div>
    </div>

    <div class="site-wrapper">
        <div class="site-wrapper-inner">
            <div class="cover-container">

                <div class="masthead clearfix">
                    <div class="inner">
                        <h4 class="masthead-brand"></h4>
                        <nav>
                            <ul class="nav masthead-nav">
                           <!-- <li class="active"><a href="http://getbootstrap.com/examples/cover/#">home</a></li> -->
                                <li><a target="new" id="refresh" ref="#">refresh</a></li>
                                <li><a target="new" id="history" ref="#">history</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="inner cover">
                    <h3 class="cover-heading"></h3>
                    <hr>
                    <div id="now-holder">
                    <p class="now"></p>
                    </div>
                    <br>

                    <div class="placeholder"></div>
                </div>

            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./lib/js/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="./lib/js/bootstrap.min.js"></script>

    <!-- Lettering library -->
    <script src="./lib/js/lettering.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./lib/js/ie10-viewport-bug-workaround.js"></script>

    <!-- Custom functions -->
    <script src="./lib/js/custom.js"></script>

</body>
</html>