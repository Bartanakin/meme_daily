<?php

namespace Barta;

use Barta\MemeRetriever\MemeNotFoundException;
use Barta\MemeRetriever\MemeRetrieverInterface;
use Barta\MemeSender\MemeSenderInterface;

class MemeSenderApp
{
    private const SHOWN_PREFIX = 'shown_';
    private const MEME_FOR_TODAY = 'Mem na dziś';
    private const NO_MEMES_MESSAGE = 'Nie znalazłem żadnych memów :cry: Proszę podeślij mi jakieś, żebym świat stał się piękniejszy :face_holding_back_tears:';

    public function __construct(
        protected MemeRetrieverInterface $memeRetriever,
        protected MemeSenderInterface $memeSender,
    ) {
    }

    public function run(): void
    {
        try {
            $meme = $this->memeRetriever->getRandomMeme(self::SHOWN_PREFIX);
        } catch (MemeNotFoundException) {
            $this->memeSender->sendMessage(self::NO_MEMES_MESSAGE);

            return;
        }

        $this->memeSender->sendMeme($meme, self::MEME_FOR_TODAY);
    }
}
