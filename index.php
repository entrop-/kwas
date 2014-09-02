<!doctype html>
<html lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="favicon.ico">
    <title>Kwas</title>
<!--    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>-->
    <script src="assets/js/vendor/jquery-1.11.min.js"></script>
    <link href="assets/stylesheets/screen.css" rel="stylesheet" >
</head>
<body>
<div class="gallery">
<?php
require 'controller/Kwas/HipChat.php';
require 'controller/Kwas/Db.php';
require 'controller/Kwas/RoomCollection.php';
require 'cfg/cfg.php';

$token = TOKEN;
$hc = new Kwas\HipChat($token);

// list rooms
//foreach ($hc->get_rooms() as $room) {
//  echo " - $room->room_id = $room->name\n";
//}

    $posts =  $hc->get_rooms_history('517400','recent');
    $posts = array_reverse($posts);


//    $room = new Kwas\RoomCollection();
//
//    $latest_date = $collection->getTopDate();

    //print_r($latest_date);


    foreach ($posts as $post) {
        $msg = $post->message;

        $images = array();

        preg_match('!http://[^?#]+\.(?:jpe?g|png)!Ui' , $msg , $images);
        //var_dump($images);
        if (!empty($images[0])) {
            $img = $images[0];


                if (@file_get_contents($img)){
                    $my_image = array_values(getimagesize($img));

        //            echo '<pre>';
        //            var_dump($my_image);
                    list($width, $height, $type, $attr) = $my_image;

                    $landscape = 'portrait';
                    if($width >= $height )
                        $landscape = 'landscape';


                    echo '<div class="element-item span-3 '.$landscape.'"><a href="#"><img src="'.$img.'" alt=""></a></div>';
                }

        }

    }

?>
</div>
<script src="assets/js/vendor/isotope.pkgd.min.js"></script>
<script src="assets/js/scripts.js"></script>
</body>
</html>