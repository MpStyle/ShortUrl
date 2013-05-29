<?php
namespace ShortUrl\BusinessLogic;

require_once __DIR__.'/AbstractShortUrl.php';

class TinyUrlShortUrl extends AbstractShortUrl
{
    const URL_REQUEST='http://tinyurl.com/api-create.php?url=%s';
    
    /**
     * @param string $url
     */
    public function __construct( $url )
    {
        parent::__construct($url);
    }
    
    public function getShortUrl()
    {
        $urlRequest = sprintf(
                TinyUrlShortUrl::URL_REQUEST
                , parent::getUrl());
        
        $output = file_get_contents( $urlRequest );
        
        return $output;
    }
}



