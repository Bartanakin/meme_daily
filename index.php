<?php

require_once __DIR__ . '/vendor/autoload.php';


$env = require __DIR__ . '/env.php';

(new \Barta\MemeSenderApp(
    new \Barta\MemeRetriever\GoogleDriveMemeRetrieverRenameProxy(
        new \Barta\MemeRetriever\GoogleDriveMemeRetriever(
            (new \Barta\MemeRetriever\DriveFactory())->create($env['google_drive_credentials_path']),
            $env['downloaded_files_temp_dir'],
        ),
    ),
    new \Barta\MemeSender\SlackMemeSender(
        $env['slack_token'],
        $env['channel_names'],
        new \Monolog\Logger('logger'),
    )
))->run();
