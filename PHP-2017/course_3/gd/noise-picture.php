<?php
session_start();
$img = imagecreatefromjpeg('images/noise.jpg');
$redColor = imagecolorallocate($img, 254, 12, 15);
imageAntiAlias($img, true);
$randStr = substr(sha1(time()), 0, 5);
$_SESSION['randstr'] = $randStr;
for($i=0; $i<5; $i++){
    imagettftext($img, rand(20, 50), rand(-50,50), 20+$i*40, 30, $redColor, 'fonts/bellb.ttf', $randStr[$i]);
}
header("Content-type: image/jpg");
imagejpeg($img,null,50);