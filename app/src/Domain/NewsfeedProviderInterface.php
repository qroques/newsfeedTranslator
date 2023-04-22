<?php

namespace App\Domain;

use App\Domain\Model\Newsfeed;

interface NewsfeedProviderInterface
{
    /**
     * @return array<Newsfeed>
     */
    public function getLatestNewsfeeds(?int $maxRecordId = null, ?bool $translate = true): array;
}
