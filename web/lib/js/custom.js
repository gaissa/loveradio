// COMMENT
(function() {

    var bTimer,
        pTimer;

    var btime = 45000;
    var ptime = 90000;

    var music = document.getElementById('music'); // Id for audio element.
    var pButton = document.getElementById('pButton'); // Play/Pause button.

    botTimer(true);
    playerTimer();
    timerFunction();

    function timerFunction()
    {
        bTimer = setInterval(function()
        {
            botTimer(false)
        },
        btime);

        pTimer = setInterval(function()
        {
            playerTimer()
        },
        ptime);
    }

    // Play and Pause button functions.
    function play()
    {
        if (music.paused)
        {
            music.play();
            pButton.className = "pause";
        }
        else
        {
            music.pause();
            pButton.className = "play";
        }
    }

    // The data loader for the player bar.
    function playerTimer()
    {
        var listeners = [];

        $.ajax(
        {
            url:"timer.php",
            type:'POST',
            success: function(data)
            {
                jQuery("#max").html(data.replace(/(<([^>]+)>)/ig, "").replace('&#2013265924;', 'Ä'));
            }
        });

        $.ajax(
        {
            url:"listeners.php",
            type:'POST',
            success: function(data)
            {
                $(data).find('td').each(function()
                {
                    listeners.push($(this).text());
                });

                for (i = 0; i < listeners.length; i++)
                {
                    if (listeners[i] == "Mount Point /love.mp3")
                    {
                        jQuery("#listeners").html("listeners: " + listeners[i+11] + " / " + listeners[i+13]);
                        $(pButton).css("visibility", "visible");
                        break;
                    }
                    else
                    {
                        jQuery("#listeners").html('<span style="color:darkred">BROADCAST OFF</span>');
                        $(pButton).css("visibility", "hidden");
                    }
                }
            }
        });
    }

    // COMMENT
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
    }

    // Get the currently playing track.
    function current(loader)
    {
        $(".now").show();

        if (loader == true)
        {
            lib(true);
        }
        else
        {
            lib(false);
        }

        var artists = [];
        var tracks = [];
        //var times = [];

        $.ajax({
           url:"current.php",
           type:'POST',
           success: function(data)
           {
                var check = false;

                $(data).find('.chartlist-timestamp span').each(function()
                {
                    //times.push($(this).text());
                    //console.log($(this).text());

                    if ($(this).text() == 'Scrobbling now')
                    {
                        check = true;
                    }
                });

                if (check == true)
                {
                    $(data).find('.chartlist-artists').each(function()
                    {
                        artists.push($.trim($(this).text()));
                    });

                    $(data).find('.link-block-target').each(function()
                    {
                        tracks.push($.trim($(this).text()));
                    });

                    for (i = 0; i < 1; i++)
                    {
                        $('.now').html(artists[i] + " - " + tracks[i]);
                        $(".now").lettering();
                    }

                    if (loader == true)
                    {
                        for (i = 0; i <= $(".now").text().length; i++ )
                        {
                            $('.now .char' + i).fadeIn(0 + (i * 100));
                            $( '.now .char' + i ).animate(
                            {
                              color: "#00AAFF",
                            }, 2000 );
                        }
                    }
                    else
                    {
                        for (i = 0; i <= $(".now").text().length; i++ )
                        {
                            $('.now .char' + i).show();
                            $( '.now .char' + i ).animate(
                            {
                              color: "#00AAFF",
                            }, 0 );
                        }
                    }
                }
                else
                {
                    //$('.now').fadeOut(4500);
					
                    $('.now').html('. . . _!_ . . .');
					$(".now").lettering();
					
					for (i = 0; i <= $(".now").text().length; i++ )
					{
						$('.now .char' + i).fadeIn(0 + (i * 100));
						$( '.now .char' + i ).animate(
						{
						  color: "#00AAFF",
						}, 2000 );
					}
                }
				

           }
        });
    }

    // COMMENT
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
                    artists.push($.trim($(this).text()));
                });

                $(data).find('.link-block-target').each(function()
                {
                    tracks.push($.trim($(this).text()));
                });

                $('.placeholder').empty(); // Empty played tracks.

                for (i = 0; i < artists.length; i++)
                {
                    $('.placeholder').append('<p class="list" id="' + i + '">' + artists[i] + " - " + tracks[i] + '</p>');

                    if (loader == true)
                    {
                        $('#' + i).fadeIn(1500 + (i * 1500));
                    }
                    else
                    {
                        $('#' + i).show();
                    }
                }

                // COMMENT
                $(window).scroll(function()
                {
                   if ($(window).scrollTop() + window.innerHeight == $(document).height())
                   {
                       $('#footer-style').show();
                   }
                   else
                   {
                       $('#footer-style').hide();
                   }
                });
            }
        });
    }

    // The play button.
    $(".play").click(function()
    {
        play();
    });

    // The volume slider.
    $("#slider").mousemove(function()
    {
        if ($(this).val() > 0)
        {
            music.volume = $(this).val()/100;
        }
        else
        {
            music.volume = 0.01;  // Prevent the clipping sound.
        }
    });

    // The refresh button.
    $("#refresh").click(function()
    {
        clearInterval(bTimer);
        clearInterval(pTimer);

        current(false);
        playerTimer();
        timerFunction();
    });

    // COMMENT
    $("#history").click(function()
    {
        // NOTHING YET
    });

})();