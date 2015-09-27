<?php

$content = file_get_contents('http://hear.fi:8000/status.xsl');
$content = preg_replace("/<img[^>]+\>/i", "", $content);
$content = preg_replace('#<head>(.*?)</head>#is', '', $content);

$d = new DOMDocument();
$d->loadHTML($content);
$s = new DOMXPath($d);

foreach($s->query('//div[contains(attribute::class, "poster")]') as $t)
{
    $t->parentNode->removeChild($t);
}

echo $d->saveHTML();

?>