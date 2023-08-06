<?php

namespace Barta\MemeSender;

use JoliCode\Slack\Client;
use JoliCode\Slack\ClientFactory;
use Barta\Meme;
use Nyholm\Psr7\Stream;
use Psr\Log\LoggerInterface;

class SlackMemeSender implements MemeSenderInterface
{
    private Client $client;

    public function __construct(
        readonly string $slackToken,
        protected readonly string $channels,
        protected LoggerInterface $logger,
    ) {
        $this->client = ClientFactory::create($slackToken);
    }

    public function sendMeme(Meme $meme, string $messageText): void
    {
        $this->client->filesUpload([
            'channels' => $this->channels,
            'initial_comment' => 'Mem na dziś:',
            'filename' => $meme->getFile()->getName(),
            'filetype' => 'jpeg',
            'file' => Stream::create(fopen($meme->getLocalPath(), 'r')),
        ]);

        $this->logger->info($meme->getFile()->getName() . ' sent to ' . $this->channels . '!');
    }

    public function sendMessage(string $messageText): void
    {
        $this->client->chatPostMessage([
            'channel' => $this->channels,
            'text' => $messageText,
        ]);

        $this->logger->warning('No memes found!');
    }
}
