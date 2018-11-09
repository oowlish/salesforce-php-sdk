<?php

declare(strict_types=1);

namespace Oowlish\Salesforce\Api\MarketingCloud;

use Oowlish\Salesforce\Api\Resource;

class Contact extends Resource
{
    public function getSchemasCollection()
    {
        return $this->marketingCloud->request('GET', '/contacts/v1/schema');
    }
}
