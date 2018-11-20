<?php

namespace Oowlish\Salesforce\Api\MarketingCloud;

use Oowlish\Salesforce\Api\Resource;

class Interaction extends Resource
{
    /**
     * Fires the entry event that initiates the journey.
     *
     * @param string $contactKey
     * @param string $eventDefinitionKey
     * @param array  $data
     *
     * @return array
     */
    public function fireEvent(string $contactKey, string $eventDefinitionKey, array $data = []): array
    {
        return $this->marketingCloud->request(
            'POST',
            '/interaction/v1/events',
            [
                'ContectKey' => $contactKey,
                'EventDefinitionKey' => $eventDefinitionKey,
                'Data' => $data
            ]
        );
    }
}
