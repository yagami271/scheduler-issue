<?php

declare(strict_types=1);

namespace App\Symfony;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final readonly class SymfonyEventBus
{
    public function __construct(
        private MessageBusInterface $messengerBusEvent,
    )
    {
    }

    public function dispatch(mixed $event): void
    {
        try {
            $this->messengerBusEvent->dispatch(new Envelope($event, [new DispatchAfterCurrentBusStamp()]));
        } catch (HandlerFailedException $e) {
            throw $e->getPrevious() ?? $e;
        }
    }
}
