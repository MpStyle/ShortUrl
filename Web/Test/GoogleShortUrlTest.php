<?php
namespace Web\Test;

error_reporting(E_ERROR | E_WARNING);
ini_set('display_errors', '1');

require_once __DIR__.'/../../BusinessLogic/GoogleShortUrl.php';

use ShortUrl\BusinessLogic\GoogleShortUrl;

$googleShortUrl=new GoogleShortUrl('www.mediana.com');
echo $googleShortUrl->getShortUrl();
