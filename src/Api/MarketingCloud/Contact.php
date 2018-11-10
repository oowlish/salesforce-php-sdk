<?php

declare(strict_types=1);

namespace Oowlish\Salesforce\Api\MarketingCloud;

use Oowlish\Salesforce\Api\Resource;

class Contact extends Resource
{
    /**
     * Retrieves the collection of all contact data schemas contained in the current account.
     *
     * @return array
     */
    public function getSchemasCollection(): array
    {
        return $this->marketingCloud->request('GET', '/contacts/v1/schema');
    }
}
