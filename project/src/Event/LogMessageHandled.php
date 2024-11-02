<?php

namespace App\Event;

use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'messenger.bus.event')]
class LogMessageHandled
{
    public function __construct(private readonly LoggerInterface $messageLogger)
    {
    }

    public function __invoke(MyMessageHandled $event): void
    {
        $this->messageLogger->info($event->message);
    }


}