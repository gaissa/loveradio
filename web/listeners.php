<?php

$content = file_get_contents('http://hear.fi:8000/status.xsl');
$content = preg_replace("/<img[^>]+\>/i", "", $content);
echo $content;

?>