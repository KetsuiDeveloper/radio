$(function(){
    var actual_vol = 1;

    var actual_song = 0;
    var last_song = 0;
    var next_song = 0;

    var song_list = [];

    var isSongLooped = false;
    $('#loop_btn').click(function(){
        !isSongLooped;
    });
    
    //set music
    $('.song').click(function(){
        var audio = document.getElementById("audio");
        var $this = $(this),
        song = $this.data('song'),
        name = $this.data('name'),
        arr_song = $this.data('arr'),
        folder = $this.data('folder');
        url = "./music_content/"+folder+"/"+song;

        var new_audio = createAudioElement(url, isSongLooped);
        if(!$this.hasClass('song-active')){
            $('#audio-here').html(new_audio);
            $('.song-active').removeClass('song-active');
            $this.addClass('song-active');
            var audio = document.getElementById("audio");
            audio.volume = actual_vol;
            setSongInfo(name);
            actual_song = arr_song;
            $('.song-picture-preview').css('background-image', "url('./music_images/"+name+".png')");
            $('.full-shadow').addClass('flip');

            setTimeout(function(){ 
                $('.full-shadow').removeClass('flip');
             }, 400);
            

            $('#audio').change(function(){
                var audio = document.getElementById("audio");
                actual_vol = audio.volume;
            });
        }

        function listenerNextSong(){
            var audio = document.getElementById("audio");
            audio.onended = function() {
                nextSong();
            }; 
        }
        function nextSong(){
            actual_song++;
            next_song = actual_song;

            //si la cancion es mayor o igual al num de canciones se resetea la lista
            if(next_song >= song_list.length){
                next_song = 0;
            }
            var new_audio = createAudioElement(song_list[next_song], isSongLooped);
            $('#audio-here').html(new_audio);

            $('.song-active').removeClass('song-active');
            $this.addClass('song-active');
            var id = parseInt(next_song)+1;

            $('#'+id).each(function(){
                $name = $(this).data('name');
                setSongInfo($name);
                $('.song-picture-preview').css('background-image', "url('./music_images/"+$name+".png')");

                $('.song-active').removeClass('song-active');
                $(this).addClass('song-active');
                //put listener
                listenerNextSong();
            });
        }
        listenerNextSong();
    });

    $('.song').each(function(){
        var $this = $(this),
        dir = "./music_content/",
        $folder = $this.data('folder'),
        $name = $this.data('song'),
        $full_url = dir+$folder+"/"+$name;
        song_list.push($full_url);
    });
    
    function setSongInfo(name){
        $('#song_name').html(name);
    }
    function createAudioElement(url, loop){
        if(loop != null && loop == true){
            var audio = "<audio id='audio' controls autoplay loop><source src='"+url+"' type='audio/mp3'></audio>";
        } else{
            var audio = "<audio id='audio' controls autoplay><source src='"+url+"' type='audio/mp3'></audio>";
        }
        return audio;
    }
    
    document.body.onkeyup = function(e){
        var audio = document.getElementById("audio");
        if(e.keyCode == 32){
            if(!audio.paused){
                e.preventDefault();
                audio.pause();
            } else if(audio.paused){
                e.preventDefault();
                audio.play();
            }
        }
        else if(e.keyCode == 38){
            //up
            if(audio.volume < 1){
                audio.volume += 0.1;
            }
        }
        else if(e.keyCode == 40){
            //down
            if(audio.volume > 0.1){
                audio.volume -= 0.1;
            }
        }
    }
    
    
});