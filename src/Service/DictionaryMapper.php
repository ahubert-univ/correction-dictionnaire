<?php

namespace App\Service;

use App\Entity\Dictionary;
use App\Entity\Language;

final readonly class DictionaryMapper
{
    public function map(string $word,string $translation,Language $sourceLanguage, Language $translationLanguage,?Dictionary $dictionary = null): Dictionary
    {
        return ($dictionary ?? new Dictionary())
            ->setWord($word)
            ->setTranslation($translation)
            ->setSourceLanguage($sourceLanguage)
            ->setTranslationLanguage($translationLanguage);
    }
}