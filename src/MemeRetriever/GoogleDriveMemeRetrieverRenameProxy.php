<?php

namespace Barta\MemeRetriever;

use DateTime;
use Google\Service\Drive\DriveFile;
use Barta\Meme;

class GoogleDriveMemeRetrieverRenameProxy implements MemeRetrieverInterface
{
    public function __construct(
        protected GoogleDriveMemeRetriever $googleDriveMemeRetriever,
    ) {
    }

    public function getRandomMeme(string $excludePrefixed = ''): Meme
    {
        $meme = $this->googleDriveMemeRetriever->getRandomMeme($excludePrefixed);

        $newFile = new DriveFile();
        $newFile->name = $excludePrefixed . '_' . (new DateTime())->getTimestamp() . $meme->getFile()->getName();
        $this->googleDriveMemeRetriever->getDrive()->files->update($meme->getFile()->getId(), $newFile);

        return $meme;
    }
}
