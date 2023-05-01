<?php

namespace Domain;

use Domain\Model\Translation;

interface TranslatorInterface
{
    public function trans(string $text): Translation;
}
