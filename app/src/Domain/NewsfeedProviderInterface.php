<?php

namespace Domain;

use Domain\Model\Newsfeed;

interface NewsfeedProviderInterface
{
    /**
     * @return array<Newsfeed>
     */
    public function getLatestNewsfeeds(?int $maxRecordId = null, ?bool $translate = true): array;
}
