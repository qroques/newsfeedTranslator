<?php

namespace App\Domain\Repository;

use App\Domain\Model\Newsfeed;

interface Newsfeeds
{
    public function findLastRecordId(): ?int;

    public function add(Newsfeed $newsfeed): void;

    public function flush(): void;

    public function findByProviderId(int $providerId): ?Newsfeed;
}
