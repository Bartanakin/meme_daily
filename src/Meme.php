<?php

namespace Barta;

use Google\Service\Drive\DriveFile;

readonly class Meme
{
    public function __construct(
        private DriveFile $file,
        private string $localPath,
    ) {
    }

    public function getLocalPath(): string
    {
        return $this->localPath;
    }

    public function getFile(): DriveFile
    {
        return $this->file;
    }

    public function __destruct()
    {
        unlink($this->localPath);
    }
}
