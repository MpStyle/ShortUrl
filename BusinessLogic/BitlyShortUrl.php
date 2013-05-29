<?php

namespace ShortUrl\BusinessLogic;

require_once __DIR__ . '/AbstractShortUrl.php';

class BitlyShortUrl extends AbstractShortUrl
{

    const URL_REQUEST = 'https://api-ssl.bitly.com/v3/shorten?access_token=%s&longUrl=%s&domain=%s';
    const URL_ACCESS_TOKEN_REQUEST = 'https://bitly.com/oauth/authorize?client_id=%s&redirect_uri=%s';
    const BIT_DOT_LY = 'bit.ly';
    const J_DOT_MP = 'j.mp';
    const BITLY_DOT_COM = 'bitly.com';

    private $accessToken = null;

    /**
     * @param string $url
     * @param string $accessToken
     */
    public function __construct( $url, $accessToken )
    {
        parent::__construct( $url );
        $this->accessToken = $accessToken;
    }

    /**
     * @param string $clientId
     * @param string $redirectUrl Deve terminare con una '/'.
     */
    public function doAuthentication( $clientId, $redirectUrl )
    {
        if ( $this->accessToken == null )
        {
            $urlAccessTokenRequest = sprintf( BitlyShortUrl::URL_ACCESS_TOKEN_REQUEST, $clientId, $redirectUrl );
            header( 'Location: ' . $urlAccessTokenRequest );
            exit();
        }
    }

    /**
     * @param string $domain Accepted value: 
     * <ul>
     *      <li>BitlyShortUrl::BIT_DOT_LY</li>
     *      <li>BitlyShortUrl::J_DOT_MP</li>
     *      <li>BitlyShortUrl::BITLY_DOT_COM</li>
     * </ul>
     * @return string|null
     */
    public function getShortUrl( $domain = BitlyShortUrl::BIT_DOT_LY )
    {
        $urlRequest = sprintf(
                BitlyShortUrl::URL_REQUEST
                , $this->accessToken
                , parent::getUrl()
                , $domain );

        $output = file_get_contents( $urlRequest );

        if ( $output === false )
        {
            return null;
        }

        $decodedResponse = json_decode( $output, true );

        if ( $decodedResponse === false || isset( $decodedResponse['data']['url'] ) === false )
        {
            return null;
        }

        return $decodedResponse['data']['url'];
    }

}

