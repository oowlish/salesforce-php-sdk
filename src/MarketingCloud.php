<?php

declare(strict_types=1);

namespace Oowlish\Salesforce;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Psr\SimpleCache\CacheInterface;

class MarketingCloud
{
    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var Client|null
     */
    private $guzzle;

    /**
     * @var CacheInterface
     */
    private $store;

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param ClientInterface|null $guzzle
     * @param $store
     */
    public function __construct(string $clientId, string $clientSecret, ClientInterface $guzzle, CacheInterface $store)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->guzzle = $guzzle;
        $this->store = $store;
    }

    public function getAccessToken()
    {
        if (!$this->store->has('salesforce-token')) {
            $response = $this->guzzle->request(
                'POST',
                'https://auth.exacttargetapis.com/v1/requestToken',
                ['json' => ['clientId' => $this->clientId, 'clientSecret' => $this->clientSecret]]
            );
            // ---
            $data = json_decode($response->getBody()->getContents(), true);

            $this->store->set('salesforce-token', $data['accessToken'], $data['expiresIn']);
        }

        return $this->store->get('salesforce-token');
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $data
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $method, string $uri, array $data = []): array
    {
        $response = $this->guzzle->request(
            $method,
            $uri,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->getAccessToken(),
                ],
                'json' => $data,
                'debug' => true
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }
}
