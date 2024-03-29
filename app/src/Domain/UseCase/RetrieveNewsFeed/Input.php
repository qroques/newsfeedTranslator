<?php

declare(strict_types=1);

namespace Domain\UseCase\RetrieveNewsFeed;

class Input
{
    public function __construct(
        public readonly ?string $lastRecordId = null
    ) {
    }
}
