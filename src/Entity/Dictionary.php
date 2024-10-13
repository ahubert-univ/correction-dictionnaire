<?php

namespace App\Entity;

use App\Repository\DictionaryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DictionaryRepository::class)]
class Dictionary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $word = null;

    #[ORM\ManyToOne(inversedBy: 'sourceDictionaries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Language $sourceLanguage = null;

    #[ORM\Column(length: 255)]
    private ?string $translation = null;

    #[ORM\ManyToOne(inversedBy: 'translationDictionaries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Language $translationLanguage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWord(): ?string
    {
        return $this->word;
    }

    public function setWord(string $word): static
    {
        $this->word = $word;

        return $this;
    }

    public function getSourceLanguage(): ?Language
    {
        return $this->sourceLanguage;
    }

    public function setSourceLanguage(?Language $sourceLanguage): static
    {
        $this->sourceLanguage = $sourceLanguage;

        return $this;
    }

    public function getTranslation(): ?string
    {
        return $this->translation;
    }

    public function setTranslation(string $translation): static
    {
        $this->translation = $translation;

        return $this;
    }

    public function getTranslationLanguage(): ?Language
    {
        return $this->translationLanguage;
    }

    public function setTranslationLanguage(?Language $translationLanguage): static
    {
        $this->translationLanguage = $translationLanguage;

        return $this;
    }
}
