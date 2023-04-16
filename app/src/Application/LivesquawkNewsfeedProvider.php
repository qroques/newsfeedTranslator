<?php

namespace App\Application;

use App\Domain\Model\Newsfeed;
use App\Domain\NewsfeedProviderInterface;
use App\Domain\TranslatorInterface;

class LivesquawkNewsfeedProvider implements NewsfeedProviderInterface
{
    public function __construct(
        private readonly TranslatorInterface $translator,
        private readonly LivesquawkClient $client
    ) {
    }

    public function getLatestNewsfeeds(?int $maxRecordId = null): array
    {
        $records = $this->client->getAllFrom($maxRecordId)['data'];
        $newsfeedArray = [];
dump($records);
        foreach($records as $record) {
            try{
                $newsfeed = new Newsfeed(
                    $record['ID'],
                    $record['record_id'],
                    (new \DateTimeImmutable())->setTimeStamp($record['date_write']),
                    $this->translator->trans($record['title']),
                    $record['subtitle'] ? $this->translator->trans($record['subtitle']) : null,
                    $record['body'] ? $this->translator->trans($record['body']) : null,
                    (bool) $record['alert']
                );
dump($newsfeed);
                $newsfeedArray[] = $newsfeed;
            } catch(\Throwable $e) {
                dump($e->getMessage());
                continue;
            }
        }

        return $newsfeedArray;
    }
}
