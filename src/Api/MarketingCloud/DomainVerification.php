<?php

declare(strict_types=1);

namespace Oowlish\Salesforce\Api\MarketingCloud;

use Oowlish\Salesforce\Api\Resource;

class DomainVerification extends Resource
{
    /**
     * Queue a bulk insert to the From Address Management table using either
     * an array of email addresses or a data extension and column reference.
     *
     * @param string      $notificationEmail
     * @param array       $addresses
     * @param string|null $dataExtensionTable
     * @param string|null $dEColumn
     *
     * @return mixed
     */
    public function domainVerificationBulkInsert(
        string $notificationEmail,
        array $addresses = [],
        string $dataExtensionTable = null,
        string $dEColumn = null
    ) {
        return $this->request(
            'POST',
            '/messaging/v1/domainverification/bulk/insert',
            [
                'NotificationEmail' => $notificationEmail,
                'Addresses' => $addresses,
                'DETable' => $dataExtensionTable,
                'DEColumn' => $dEColumn,
            ]
        );
    }
}
