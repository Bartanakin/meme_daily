<?php

namespace Barta\MemeRetriever;

use Google\Client as GoogleClient;
use Google\Service\Drive;

class DriveFactory implements DriveFactoryInterface
{
    public function create(string $credentialsPath): Drive
    {
        $googleClient = new GoogleClient();
        $googleClient->setAuthConfig($credentialsPath);
        $googleClient->addScope(Drive::DRIVE);

        return new Drive($googleClient);
    }
}
