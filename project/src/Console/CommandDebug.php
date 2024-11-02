<?php

namespace App\Console;

use App\Message\MyMessage;
use App\Symfony\SymfonyCommandBus;
use http\Exception\RuntimeException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Scheduler\Attribute\AsCronTask;

#[AsCommand(name: 'app:command-debug')]
#[AsCronTask('* * * * *')]
class CommandDebug extends Command
{
    public function __construct(
        private readonly SymfonyCommandBus $commandBus,
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
       $output->writeln('run...');


       for ($i = 0; $i < 100; ++$i) {

           if($i === 98){
               /**
                * With this exception we will se no log from LogMessageHandled
                *
                * comment this line and run php bin/console messenger:consume scheduler_default --limit=1 -vvv
                * you will see log from events
                *
                */
//               throw new RuntimeException('Exception...');
           }
           $this->commandBus->dispatch(
               new MyMessage(
                   \sprintf('Message #%d', $i),
               )
           );
       }

       return Command::SUCCESS;
    }
}