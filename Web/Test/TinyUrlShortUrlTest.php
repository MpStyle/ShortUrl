<?php
namespace Web\Test;

error_reporting(E_ERROR | E_WARNING);
ini_set('display_errors', '1');

require_once __DIR__.'/../../BusinessLogic/TinyUrlShortUrl.php';

use ShortUrl\BusinessLogic\TinyUrlShortUrl;

$tinyUrlShortUrl=new TinyUrlShortUrl('http://www.mediana.com');
echo $tinyUrlShortUrl->getShortUrl();
