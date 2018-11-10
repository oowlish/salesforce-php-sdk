<?php

declare(strict_types=1);

namespace Oowlish\Salesforce;

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
     * @var ClientInterface
     */
    private $guzzle;

    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * @param string          $clientId
     * @param string          $clientSecret
     * @param ClientInterface $guzzle
     * @param CacheInterface  $cache
     */
    public function __construct(string $clientId, string $clientSecret, ClientInterface $guzzle, CacheInterface $cache)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->guzzle = $guzzle;
        $this->cache = $cache;
    }

    /**
     * @return string
     */
    private function getAccessToken(): string
    {
        if (!$this->cache->has('salesforce.marketing_cloud.access_token')) {
            $response = $this->guzzle->request('POST', 'https://auth.exacttargetapis.com/v1/requestToken', [
                'json' => [
                    'clientId' => $this->clientId,
                    'clientSecret' => $this->clientSecret,
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            $this->cache->set('salesforce.marketing_cloud.access_token', $data['accessToken'], $data['expiresIn']);
        }

        return $this->cache->get('salesforce.marketing_cloud.access_token');
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array  $data
     *
     * @return array
     *
     * @throws GuzzleException
     */
    public function request(string $method, string $uri, array $data = []): array
    {
        $response = $this->guzzle->request($method, $uri, [
            'json' => $data,
            'headers' => [
                'Authorization' => "Bearer {$this->getAccessToken()}",
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
