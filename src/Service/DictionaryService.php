<?php

namespace App\Service;

use App\Entity\Dictionary;
use App\Entity\Language;
use App\Repository\LanguageRepository;
use Doctrine\ORM\EntityManagerInterface;

final readonly class DictionaryService
{
    public function __construct(private EntityManagerInterface $entityManager,
                                private DictionaryMapper       $dictionaryMapper,
                                private LanguageRepository     $languageRepository,
    )
    {
    }

    public function create(string $word, string $translation, string $sourceLanguage, string $translationLanguage): Dictionary
    {
        [$sourceObjectLanguage, $translationObjectLanguage] = $this->searchLanguages($sourceLanguage, $translationLanguage);

        $dictionary = $this->dictionaryMapper->map($word, $translation, $sourceObjectLanguage, $translationObjectLanguage);

        $this->entityManager->persist($dictionary);
        $this->entityManager->flush();

        return $dictionary;
    }

    public function update(Dictionary $dictionary, string $word, string $translation, string $sourceLanguage, string $translationLanguage): Dictionary
    {
        [$sourceObjectLanguage, $translationObjectLanguage] = $this->searchLanguages($sourceLanguage, $translationLanguage);

        $dictionary = $this->dictionaryMapper->map($word, $translation, $sourceObjectLanguage, $translationObjectLanguage, $dictionary);

        $this->entityManager->persist($dictionary);
        $this->entityManager->flush();

        return $dictionary;
    }

    public function delete(Dictionary $dictionary): void
    {
        $this->entityManager->remove($dictionary);
        $this->entityManager->flush();
    }


    private function searchLanguages(string $sourceLanguage, string $translationLanguage): array
    {
        $sourceObjectLanguage = $this->languageRepository->findOneBy(['lang' => $sourceLanguage]);
        $translationObjectLanguage = $this->languageRepository->findOneBy(['lang' => $translationLanguage]);

        if (!$sourceObjectLanguage instanceof Language || !$translationObjectLanguage instanceof Language) {
            throw new \RuntimeException("Language is incorrect only support fr , es, en");
        }
        return array($sourceObjectLanguage, $translationObjectLanguage);
    }
}