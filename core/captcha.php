<?php
if (preg_match("/captcha.php/i", $_SERVER['PHP_SELF'])) die("Non puoi linkare questa pagina direttamente!");

@session_start();
$text = rand(10000,99999);
$_SESSION["captcha"] = $text;

$height = 25;
$width  = 65;
  
$image = imagecreate($width, $height);

$black = imagecolorallocate($image, 0, 0, 0); 
$white = imagecolorallocate($image, 255, 255, 255);

$font_size = 14;  

imagestring($image, $font_size, 5, 5, $text, $white); 
imagejpeg($image, null, 80);
imagedestroy($image);
?> 

