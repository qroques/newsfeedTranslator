<?php

namespace Application;

use Domain\Model\Translation;
use InvalidArgumentException;
use Symfony\Contracts\HttpClient\ResponseInterface;

class TranslationFactory
{
    public static function fromDeeplResponse(string $translatedLocale, string $originalText, ResponseInterface $deeplResponse): Translation
    {
        if (200 !== $deeplResponse->getStatusCode()) {
            throw new InvalidArgumentException('Cannot build object Translation because response is not valid');
        }

        $arrayDeeplResponse = $deeplResponse->toArray();

        if (
            array_key_exists('translations', $arrayDeeplResponse)
            && array_key_exists(0, $arrayDeeplResponse['translations'])
            && array_key_exists('text', $arrayDeeplResponse['translations'][0])
        ) {
            return new Translation(
                $originalText,
                $arrayDeeplResponse['translations'][0]['detected_source_language'],
                $arrayDeeplResponse['translations'][0]['text'],
                $translatedLocale
            );
        } else {
            throw new InvalidArgumentException('Cannot build object Translation because response is not valid');
        }
    }
}
