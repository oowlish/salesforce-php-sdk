<?php

declare(strict_types=1);

namespace Oowlish\Salesforce\Endpoints;

abstract class AbstractEndpoint
{
    /**
     * @return string
     */
    abstract public function getHttpMethod(): string;

    /**
     * @return string
     */
    abstract public function getURI(): string;

    /**
     * @return array
     */
    abstract public function getBody(): array;
}
