<?php

namespace App\Domain\Model;

use Ramsey\Uuid\Uuid;

class Newsfeed
{
    private string $uuid;
    public readonly \DateTimeImmutable $createdAt;

    public function __construct(
        private int $providerId,
        private int $providerRecordId,
        private \DateTimeImmutable $writtenAt,
        private Translation $title,
        private ?Translation $subtitle,
        private ?Translation $body,
        private bool $alert,
    ) {
        $this->uuid      = Uuid::uuid4();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getProviderId(): int
    {
        return $this->providerId;
    }

    public function getProviderRecordId(): int
    {
        return $this->providerRecordId;
    }

    public function getwrittenAt(): \DateTimeImmutable
    {
        return $this->writtenAt;
    }

    public function getTitle(): Translation
    {
        return $this->title;
    }

    public function getSubtitle(): ?Translation
    {
        return $this->subtitle;
    }

    public function getBody(): ?Translation
    {
        return $this->body;
    }

    public function isAlert(): bool
    {
        return $this->alert;
    }
}
