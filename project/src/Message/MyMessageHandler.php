<?php

namespace App\Message;

use App\Event\MyMessageHandled;
use App\Symfony\SymfonyEventBus;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(bus: 'messenger.bus.command')]
class MyMessageHandler
{

    public function __construct(private readonly SymfonyEventBus $eventBus)
    {
    }

    public function __invoke(MyMessage $command): void
    {
        // do stuff...

        $this->eventBus->dispatch(new MyMessageHandled($command->message));
    }


}