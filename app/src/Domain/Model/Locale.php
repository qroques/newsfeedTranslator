<?php

namespace Domain\Model;

class Locale
{
    public function __construct(
        private readonly string $locale
    ) {
    }

    public function __toString()
    {
        return $this->locale;
    }
}
