// Comment...
(function() {

    var music = document.getElementById('music'); // id for audio element
    var pButton = document.getElementById('pButton'); // play button

    botTimer(true);
    var timer = setInterval(function () {botTimer(false)}, 45000);

    // Play and Pause
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

    // Comment
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

    // Comment
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
                        {   $(".now").show();
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


    // Comment
    $("#history").click(function()
    {
        //$('.placeholder').empty();
    });


    // Comment
    $(".play").click(function()
    {
        play();
    });


    // Comment
    $("#refresh").click(function()
    {
        $(".now").toggle("explode");

        $(".placeholder").toggle("explode").promise().done(function(){
            current(true);

        });
    });


    // Comment
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

})();