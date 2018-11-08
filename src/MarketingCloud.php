<?php

declare(strict_types=1);

namespace Oowlish\Salesforce;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Oowlish\Salesforce\Endpoints\AbstractEndpoint;

class MarketingCloud
{
    const BASE_URI = 'https://www.exacttargetapis.com';
    const AUTH_URI = 'https://auth.exacttargetapis.com/v1';

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
     * @param string $clientId
     * @param string $clientSecret
     * @param ClientInterface|null $guzzle
     */
    public function __construct(string $clientId, string $clientSecret, ClientInterface $guzzle = null)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->guzzle = $guzzle ?: new Client(['base_uri' => self::BASE_URI]);
    }

    /**
     * @param AbstractEndpoint $endpoint
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return array
     */
    public function dispatch(AbstractEndpoint $endpoint): array
    {
        $response = $this->guzzle->request(
            $endpoint->getHttpMethod(),
            $endpoint->getURI(),
            ['json' => $endpoint->getBody()]
        );

        return [$response->getBody()->getContents()];
    }
}
