<?php

namespace Application;

use Domain\Model\Newsfeed;
use Domain\NewsfeedProviderInterface;
use Domain\TranslatorInterface;

class LivesquawkNewsfeedProvider implements NewsfeedProviderInterface
{
    public function __construct(
        private readonly TranslatorInterface $translator,
        private readonly LivesquawkClient $client
    ) {
    }

    public function getLatestNewsfeeds(?int $maxRecordId = null, ?bool $translate = true): array
    {
        $records = $this->client->getAllFrom($maxRecordId)['data'];
        $newsfeedArray = [];

        foreach($records as $record) {
            try{
                $newsfeed = new Newsfeed(
                    $record['ID'],
                    $record['record_id'],
                    (new \DateTimeImmutable())->setTimeStamp($record['date_write']),
                    $this->translator->trans($record['title']),
                    $record['subtitle'] && $translate ? $this->translator->trans($record['subtitle']) : null,
                    $record['body'] && $translate ? $this->translator->trans($record['body']) : null,
                    (bool) $record['alert']
                );

                $newsfeedArray[] = $newsfeed;
            } catch(\Throwable $e) {
                continue;
            }
        }

        return $newsfeedArray;
    }
}
