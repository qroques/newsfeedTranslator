<?php

declare(strict_types=1);

namespace Domain\UseCase\RetrieveNewsFeed;

use Domain\NewsfeedProviderInterface;
use Domain\Repository\Newsfeeds;

class Handler
{
    public function __construct(
        private readonly NewsfeedProviderInterface $newsfeedProvider,
        private readonly Newsfeeds $newsfeedsRepository
    ) {
    }

    public function __invoke(Input $input): void
    {
        $lastRecordId = $input->lastRecordId ?? $this->newsfeedsRepository->findLastRecordId();

        $records = $this->newsfeedProvider->getLatestNewsfeeds($lastRecordId, (bool) $lastRecordId);

        foreach ($records as $newsfeed) {
            if ($this->newsfeedsRepository->findByProviderId($newsfeed->getProviderId())) {
                continue;
            }

            $this->newsfeedsRepository->add($newsfeed);
        }

        $this->newsfeedsRepository->flush();
    }
}
