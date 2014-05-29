<?php
namespace OAuth\OAuth1\Service;

use OAuth\OAuth1\Signature\SignatureInterface;
use OAuth\OAuth1\Token\StdOAuth1Token;
use OAuth\Common\Http\Exception\TokenResponseException;
use OAuth\Common\Http\Uri\Uri;
use OAuth\Common\Consumer\CredentialsInterface;
use OAuth\Common\Http\Uri\UriInterface;
use OAuth\Common\Storage\TokenStorageInterface;
use OAuth\Common\Http\Client\ClientInterface;

class Yelp extends AbstractService {

  public function __construct(
        CredentialsInterface $credentials,
        ClientInterface $httpClient,
        TokenStorageInterface $storage,
        SignatureInterface $signature,
        UriInterface $baseApiUri = null
    ) {
        parent::__construct($credentials, $httpClient, $storage, $signature, $baseApiUri);

        if (null === $baseApiUri) {
            $this->baseApiUri = new Uri('http://api.yelp.com/v2/');
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function getRequestTokenEndpoint()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthorizationEndpoint()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getAccessTokenEndpoint()
    {
        return null
    }

    /**
     * {@inheritdoc}
     */
    protected function parseRequestTokenResponse($responseBody)
    {
        return null;

    /**
     * {@inheritdoc}
     */
    protected function parseAccessTokenResponse($responseBody)
    {
        return null;
    }
    
    public function setAccessTokenWithData($data)
    {
        $token = new StdOAuth1Token();

        $token->setRequestToken($data['oauth_token']);
        $token->setRequestTokenSecret($data['oauth_token_secret']);
        $token->setAccessToken($data['oauth_token']);
        $token->setAccessTokenSecret($data['oauth_token_secret']);

        $token->setEndOfLife(StdOAuth1Token::EOL_NEVER_EXPIRES);
        unset($data['oauth_token'], $data['oauth_token_secret']);
        $token->setExtraParams($data);
      
        $this->storage->storeAccessToken($this->service(), $token);
    }
}
