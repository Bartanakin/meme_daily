<?php

namespace Barta\MemeRetriever;

use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Barta\Meme;

class GoogleDriveMemeRetriever implements MemeRetrieverInterface
{
    public function __construct(
        protected Drive $drive,
        protected readonly string $tempFilesDir,
    ) {
    }

    public function getRandomMeme(string $excludePrefixed = ''): Meme
    {
        $files = $this->drive->files->listFiles([
            'q' => "mimeType='image/jpeg' and not fullText contains '" . $excludePrefixed . "'",
            'spaces' => 'drive',
        ]);

        if (empty($files->getFiles())) {
            throw new MemeNotFoundException();
        }

        /** @var DriveFile $file */
        $file = $files[array_rand($files->getFiles())];
        $downloadedFilePath = $this->tempFilesDir . $file->getName();
        file_put_contents($downloadedFilePath, $this->drive->files->get($file->getId(), ['alt' => 'media'])->getBody()->getContents());

        return new Meme($file, $downloadedFilePath);
    }

    public function getDrive(): Drive
    {
        return $this->drive;
    }
}
