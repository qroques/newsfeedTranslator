<?php

namespace App\Doctrine\Repository;

use App\Domain\Model\Newsfeed;
use App\Domain\Repository\Newsfeeds as NewsfeedsInterface;
use Doctrine\ORM\EntityManagerInterface;

class Newsfeeds implements NewsfeedsInterface
{
    /**
     * @var \Doctrine\ORM\EntityRepository<Newsfeed>
     */
    private \Doctrine\ORM\EntityRepository $innerRepository;

    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        $this->innerRepository = $this->entityManager->getRepository(Newsfeed::class);
    }

    /**
     * {@inheritdoc}
     */
    public function add(Newsfeed $newsfeed): void
    {
        $this->entityManager->persist($newsfeed);
    }

    public function flush(): void
    {
        $this->entityManager->flush();
    }

    public function findLastRecordId(): ?int
    {
        $lastRecord = $this->innerRepository->findOneBy([], ['providerRecordId' => 'DESC']);

        return $lastRecord ? $lastRecord->getProviderId() : null;
    }

    public function findByProviderId(int $providerId): ?Newsfeed
    {
        return $this->innerRepository->findOneBy(['providerId' => $providerId]);
    }
}
