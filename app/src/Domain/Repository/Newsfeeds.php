<?php

namespace Domain\Repository;

use Domain\Model\Newsfeed;

interface Newsfeeds
{
    public function findLastRecordId(): ?int;

    public function add(Newsfeed $newsfeed): void;

    public function flush(): void;

    public function findByProviderId(int $providerId): ?Newsfeed;

    /**
     * @return array<Newsfeed>
     */
    public function findAll(PaginationQuery $paginationQuery): array;
}
