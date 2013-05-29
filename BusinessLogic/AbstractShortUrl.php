<?php
namespace ShortUrl\BusinessLogic;

abstract class AbstractShortUrl
{
    private $url;
    
    /**
     * @param string $url
     */
    public function __construct( $url )
    {
        $this->url=$url;
    }
    
    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl( $url )
    {
        $this->url = $url;
        return $this;
    }
    
    /**
     * @return String
     */
    public abstract function getShortUrl();
}


