<?php

declare(strict_types=1);

namespace Oowlish\Salesforce\Api;

use Oowlish\Salesforce\MarketingCloud;

abstract class Resource
{
    protected $marketingCloud;

    public function __construct(MarketingCloud $marketingCloud)
    {
        $this->marketingCloud = $marketingCloud;
    }
}
