<?php

$string = file_get_contents('https://www.last.fm/user/ceniq/library');

$string = preg_replace("/<img[^>]+\>/i", "", $string);

echo $string;

?>