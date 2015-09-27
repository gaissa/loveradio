<?php

header('Content-Type: text/html; charset=ISO-8859-15');

$content = file_get_contents('https://www.hear.fi/looppi/');
echo trim(strip_tags($content));

?>