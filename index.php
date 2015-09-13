<!DOCTYPE html>

<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
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
        <button id="pButton" class="play" onclick="play()"></button>
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

    <script src="./lib/js/lettering.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./lib/js/ie10-viewport-bug-workaround.js"></script>

    <script>

    var music = document.getElementById('music'); // id for audio element
    var pButton = document.getElementById('pButton'); // play button

    //Play and Pause
    function play()
    {
        if (music.paused)
        {
            music.play();
            pButton.className = "";
            pButton.className = "pause";
        }
        else
        {
            music.pause();
            pButton.className = "";
            pButton.className = "play";
        }
    }

    botTimer(true);
    var timer = setInterval(function () {botTimer(false)}, 45000);

    function botTimer(loader)
    {
        if (loader == false)
        {
            current(false);
        }
        else
        {
            current(true);
        }

        $.ajax(
        {
           url:"timer.php",
           type:'POST',
           success: function(data)
           {
                jQuery("#max").html(data.replace(/(<([^>]+)>)/ig, "").replace('&#2013265924;', 'Ä'));
           }
        });
    }

    function current(loader)
    {
        var artists = [];
        var tracks = [];
        var times = [];

        $.ajax({
           url:"current.php",
           type:'POST',
           success: function(data)
           {
                var check = false;

                $(data).find('.chartlist-timestamp span').each(function()
                {
                    times.push($(this).text());
                    console.log($(this).text());

                    if ($(this).text() == 'Scrobbling now')
                    {
                        check = true;
                    }
                });

                if (check == true)
                {
                    $(data).find('.chartlist-artists').each(function()
                    {
                        artists.push($(this).text());
                    });

                    $(data).find('.link-block-target').each(function()
                    {
                        tracks.push($(this).text());
                    });

                    for (i = 0; i < 1; i++)
                    {
                        $('.now').html(artists[i] + " - " + tracks[i]);
                        $(".now").lettering();
                    }

                    if (loader == true)
                    {
                        for (i = 0; i <= $(".now").text().length; i++ )
                        {	$(".now").show();
                            $('.now .char' + i).fadeIn(1000 + (i * 100));
                            //$( '.now .char' + i ).animate(
                            //{
                              //color: "#00AAFF",
                            //}, 1111 );
                        }
                    }
                    else
                    {
                        for (i = 0; i <= $(".now").text().length; i++ )
                        {
                            $('.now .char' + i).show();
                            //$( '.now .char' + i ).animate(
                            //{
                              //color: "#00AAFF",
                            //}, 0 );
                        }
                    }
                }
				else
				{
					$('.now').fadeOut(4500);
				}
				
                if (loader == true)
                {						
                    lib(true);
                }
                else
                {
                    lib(false);
                }
           }
        });
    }

    $("#history").click(function()
	{
        //$('.placeholder').empty();		
    });
	
	$("#refresh").click(function()
	{		
		$(".now").toggle("explode");
		
		$(".placeholder").toggle("explode").promise().done(function(){
			current(true);
				
		});				
    });

    function lib(loader)
    {
        var artists = [];
        var tracks = [];

        $.ajax(
        {
            url:"library.php",
            type:'POST',
            success: function(data)
            {	
                $(data).find('.chartlist-artists').each(function()
                {
                    artists.push($(this).text());				 
                });

                $(data).find('.link-block-target').each(function()
                {
                    tracks.push($(this).text());
                });

                $('.placeholder').empty();

                for (i = 0; i < artists.length; i++)
                {
                    $('.placeholder').append('<p class="list" id="' + i + '">' + artists[i] + " - " + tracks[i] + '</p>');

                    //$('#' + i).lettering();
                    if (loader == true)
                    {	
						$(".placeholder").show();
                        $('#' + i).fadeIn(1500 + (i * 500));
                    }
                    else
                    {
                        $('#' + i).show();
                    }
                }
            }
        });
    }

    </script>

</body>
</html>