<?php
namespace ShortUrl\BusinessLogic;

require_once __DIR__.'/AbstractShortUrl.php';

class GoogleShortUrl extends AbstractShortUrl
{
    const URL_REQUEST='https://www.googleapis.com/urlshortener/v1/url';
    
    /**
     * @param string $url
     */
    public function __construct( $url )
    {
        parent::__construct($url);
    }
    
    /**
     * @return String
     */
    public function getShortUrl()
    {
        // Crea la risorsa CURL
        $ch = curl_init();

        $postData=array('longUrl' => parent::getUrl() );
        
        // Imposta l'URL e altre opzioni
        curl_setopt($ch, CURLOPT_URL, GoogleShortUrl::URL_REQUEST);
        curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $postData ) );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        
        // Scarica l'URL e lo passa al browser
        $output = curl_exec( $ch );
        $info = curl_getinfo($ch, CURLINFO_HTTP_CODE );
        
        // Chiude la risorsa curl
        curl_close($ch);
        
        if ($output === false || $info != 200) 
        {
            return null;
        }
        
        $decodedResponse= json_decode($output, true);
        
        if( $decodedResponse===false || isset( $decodedResponse['id'] )===false )
        {
            return null;
        }
        
        return $decodedResponse['id'];
    }
}


