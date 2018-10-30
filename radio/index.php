<?php session_start(); ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="./assets/css/main.css">
        <link rel="stylesheet" href="./assets/css/media.css">
        <script src="./assets/js/jquery.js"></script>
        <script src="./assets/js/main.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="icon" href="./assets/images/visual/arrow.png" type="image/png"> 
        <title>Radio</title>
    </head>
    <body>
    

        <div class="container">
           <div class="container-down">
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <div class="full-shadow">
                            <div class="song-picture-preview"></div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-lg-9">
                        <h3 class="d-none">Canciones</h3>

                        <div class="controllers">
                            <div class="row">
                                <div class="col-12 col-lg-3">
                                    <marquee scrollamount="4" id='song_name'>Elige una canción</marquee>
                                </div>
                                <div class="col-12 col-lg-9" id='audio-here'>
                                    <audio id='audio' controls loop>
                                        <source src='<?php echo "./music_content/1/".$final_music[0]; ?>' type='audio/mp3'>
                                    </audio>
                                </div>
                            </div>
                        </div>

                        <ul class="list">
                            <?php
                                $parent_dir = "./music_content/";
                                $lists = scandir($parent_dir);
                                $final_music = array();

                                for ($folder=0; $folder < sizeOf($lists); $folder++) { 
                                    if(is_numeric($lists[$folder])){
                                        $dir = "./music_content/".$lists[$folder]."/";
                                        $music_list = scandir($dir);
                                        $file_type = ["mp3"];
                                        $song_num = 1;
                                        for ($i=0; $i < sizeOf($music_list); $i++) {
                                            $ext = preg_split("/[.]+/", $music_list[$i]);
                                            $name = $ext[0];
                                            $ext = $ext[1];
                                            
                                            if(in_array($ext, $file_type)):?>
                                                <li class="song" id="<?php echo $song_num; ?>" data-arr="<?php echo $song_num-1; ?>" data-folder="<?php echo $lists[$folder]; ?>" data-song="<?php echo $music_list[$i]; ?>" data-name="<?php echo $name; ?>"><?php echo "<span class='song-badge'>".$song_num."</span>".$name; ?></li>
                                                <?php 
                                                $song_num++;
                                                
                                                array_push($final_music, $music_list[$i]);
                                                ?>
                                            <?php endif;
                                        }
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>
           </div>
        </div>

        <div class="controllers d-none">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <marquee scrollamount="4" id='song_name'> 
                        <?php $ext = preg_split("/[.]+/", $final_music[0]); $name = $ext[0]; echo $name; ?>
                    </marquee>
                </div>
                <div class="col-12 col-lg-6" id='audio-here'>
                    <audio id='audio' controls loop>
                        <source src='<?php echo "./music_content/1/".$final_music[0]; ?>' type='audio/mp3'>
                    </audio>
                </div>
                <div class="col-12 col-lg-3"></div>
            </div>
        </div>
        
    </body>
</html>