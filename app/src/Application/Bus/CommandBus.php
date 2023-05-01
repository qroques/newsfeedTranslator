<?php

declare(strict_types=1);

namespace Application\Bus;

interface CommandBus
{
    public function dispatch(object $input): mixed;
}
