<?php

declare(strict_types=1);

namespace Application\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

#[AsCommand(
    name: 'app:date',
    description: 'Displays current date',
)]
class DateCommand extends Command
{
    public function __construct(private readonly HubInterface $hub)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $date = (new \DateTimeImmutable())->format(\DateTime::ATOM);
        $output->writeln($date);
        $update = new Update(
            'https://date',
            json_encode(['date' => $date])
        );

        $this->hub->publish($update);
        $output->writeln('published');

        return Command::SUCCESS;
    }
}
