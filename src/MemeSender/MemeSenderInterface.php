<?php

namespace Barta\MemeSender;

use Barta\Meme;

interface MemeSenderInterface
{
    public function sendMeme(Meme $meme, string $messageText): void;

    public function sendMessage(string $messageText): void;
}
