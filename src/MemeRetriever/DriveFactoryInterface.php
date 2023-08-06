<?php

namespace Barta\MemeRetriever;

use Google\Service\Drive;

interface DriveFactoryInterface
{
    public function create(string $credentialsPath): Drive;
}
