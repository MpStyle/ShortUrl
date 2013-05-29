<?php
namespace ShortUrl\Web\Test;

$clientID= ''; // The client ID of the app registered in Bitly
$clientRedirectUrl=''; // Current web path

error_reporting(E_ERROR | E_WARNING);
ini_set('display_errors', '1');

require_once __DIR__.'/../../BusinessLogic/BitlyShortUrl.php';

use ShortUrl\BusinessLogic\BitlyShortUrl;

        
$bitlyShortUrl=new BitlyShortUrl('www.mediana.com', $_GET['code']);
$bitlyShortUrl->doAuthentication($clientID, $clientRedirectUrl);

echo $bitlyShortUrl->getShortUrl();