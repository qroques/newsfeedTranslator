<?php

declare(strict_types=1);

namespace Infrastructure\Symfony\Messenger;

use Application\Bus\CommandBus as CommandBusInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class CommandBus implements CommandBusInterface
{
    use HandleTrait;

    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    public function dispatch(object $input): mixed
    {
        try {
            return $this->handle($input);
        } catch (HandlerFailedException $handlerFailedException) {
            $nestedExceptions = $handlerFailedException->getNestedExceptions();

            if (false === $nested = current($nestedExceptions)) {
                throw $handlerFailedException;
            }

            throw $nested;
        }
    }
}
