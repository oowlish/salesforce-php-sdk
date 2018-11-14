<?php

declare(strict_types=1);

namespace Oowlish\Salesforce\Api\MarketingCloud;

use Oowlish\Salesforce\Api\Resource;

class Messaging extends Resource
{
    /**
     * Sends transactional email using Marketing Cloud's triggered send functionality.
     * In order to use this service, configure a triggered send definition in Email Studio.
     *
     * @param string $triggeredSendDefinitionId
     * @param array  $from
     * @param array  $to
     * @param array  $options
     *
     * @return array
     */
    public function sendEmail(string $triggeredSendDefinitionId, array $from, array $to, array $options): array
    {
        return $this
            ->marketingCloud
            ->request(
                'POST',
                "/messaging/v1/messageDefinitionSends/{$triggeredSendDefinitionId}/send",
                [
                    $from,
                    $to,
                    $options,
                ]
            );
    }
}
