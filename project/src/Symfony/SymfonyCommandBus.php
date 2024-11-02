<?php

declare(strict_types=1);

namespace App\Symfony;

use App\Common\Application\Bus\{CommandBus, NoHandlerForCommand};
use App\Common\Domain\MessageTagEngine;
use Override;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\Exception\{HandlerFailedException, NoHandlerForMessageException};
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DelayStamp;

final readonly class SymfonyCommandBus
{
    public function __construct(
        private MessageBusInterface $messengerBusCommand,
    )
    {
    }

    public function dispatch(mixed $command): void
    {
        try {
            $this->messengerBusCommand->dispatch($command);
        } catch (HandlerFailedException $e) {
            throw $e->getPrevious() ?? $e;
        }
    }
}
