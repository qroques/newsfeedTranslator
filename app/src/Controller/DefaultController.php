<?php

namespace App\Controller;

use App\Application\LivesquawkClient;
use App\Domain\NewsfeedProviderInterface;
use App\Domain\Repository\Newsfeeds;
use App\Domain\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function __construct(
        private readonly TranslatorInterface $translator,
        private readonly LivesquawkClient $client,
        private readonly NewsfeedProviderInterface $newsfeedProvider,
        private readonly Newsfeeds $newsfeedsRepository
    )
    {
    }

    public function __invoke(): Response
    {
        $lastRecordId = $this->newsfeedsRepository->findLastRecordId();

        $records = $this->newsfeedProvider->getLatestNewsfeeds($lastRecordId, (bool) $lastRecordId);

        foreach ($records as $newsfeed) {
            if ($this->newsfeedsRepository->findByProviderId($newsfeed->getProviderId())) {
                continue;
            }
            $this->newsfeedsRepository->add($newsfeed);
        }
        $this->newsfeedsRepository->flush();

        return new JsonResponse();
    }
}
