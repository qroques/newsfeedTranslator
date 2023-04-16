<?php

namespace App\Domain\Model;

use Ramsey\Uuid\Uuid;

class Translation
{
    private string $uuid;
    public function __construct(
        private readonly string $originalText,
        private readonly string $originalLocale,
        private readonly string $translatedText,
        private readonly string $translatedLocale,
    ) {
        $this->uuid = Uuid::uuid4();
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function __toString(): string
    {
        return $this->translatedText;
    }

    public function getOriginalText(): string
    {
        return $this->originalText;
    }

    public function getOriginalLocale(): string
    {
        return $this->originalLocale;
    }

    public function getTranslatedText(): string
    {
        return $this->translatedText;
    }

    public function getTranslatedLocale(): string
    {
        return $this->translatedLocale;
    }
}
