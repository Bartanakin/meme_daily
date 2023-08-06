<?php

namespace Barta\MemeRetriever;

use Barta\Meme;

interface MemeRetrieverInterface
{
    /**
     * @throws MemeNotFoundException
     */
    public function getRandomMeme(string $excludePrefixed = ''): Meme;
}
