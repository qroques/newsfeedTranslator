<?php

declare(strict_types=1);

namespace Application\Command;

use Application\Bus\CommandBus;
use Domain\UseCase\RetrieveNewsFeed\Input;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

#[AsCommand(
    name: 'app:retrieve-news-feed',
    description: 'Displays current date',
)]
class RetrieveNewsFeedCommand extends Command
{
    public function __construct(private readonly CommandBus $commandBus)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addOption(
            'last-record-id',
            'i',
            InputOption::VALUE_OPTIONAL,
            'Last record id'
        );
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $lastRecordId = $input->getOption('last-record-id');
        $this->commandBus->dispatch(new Input($lastRecordId));
        $output->writeln('published');

        return Command::SUCCESS;
    }
}
