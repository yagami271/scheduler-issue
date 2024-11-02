<?php

declare(strict_types=1);

namespace App\Console;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Messenger\RunCommandMessage;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Scheduler\Event\PostRunEvent;

#[AsEventListener(event: PostRunEvent::class)]
final readonly class SchedulerCheckerListener
{
    public function __construct(
        private LoggerInterface $logger,
    ) {
    }

    /**
     * We will use this class on release for one day to check that every thing is ok and deleted before production deploy
     */
    public function __invoke(PostRunEvent $event): void
    {
        $message = $event->getMessage();
        if ($message instanceof RunCommandMessage) {
            $this->logger->info('[CRON_TASK_EXECUTION]', [
                'command' => $message->input,
                'triggeredAt' => $event->getMessageContext()->triggeredAt->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
