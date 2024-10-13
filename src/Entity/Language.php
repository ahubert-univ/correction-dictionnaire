<?php

namespace App\Entity;

use App\Repository\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lang = null;

    /**
     * @var Collection<int, Dictionary>
     */
    #[ORM\OneToMany(targetEntity: Dictionary::class, mappedBy: 'sourceLanguage', orphanRemoval: true)]
    private Collection $sourceDictionaries;

    /**
     * @var Collection<int, Dictionary>
     */
    #[ORM\OneToMany(targetEntity: Dictionary::class, mappedBy: 'translationLanguage', orphanRemoval: true)]
    private Collection $translationDictionaries;

    public function __construct()
    {
        $this->sourceDictionaries = new ArrayCollection();
        $this->translationDictionaries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(string $lang): static
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * @return Collection<int, Dictionary>
     */
    public function getSourceDictionaries(): Collection
    {
        return $this->sourceDictionaries;
    }

    public function addSourceDictionary(Dictionary $sourceDictionary): static
    {
        if (!$this->sourceDictionaries->contains($sourceDictionary)) {
            $this->sourceDictionaries->add($sourceDictionary);
            $sourceDictionary->setSourceLanguage($this);
        }

        return $this;
    }

    public function removeSourceDictionary(Dictionary $sourceDictionary): static
    {
        if ($this->sourceDictionaries->removeElement($sourceDictionary)) {
            // set the owning side to null (unless already changed)
            if ($sourceDictionary->getSourceLanguage() === $this) {
                $sourceDictionary->setSourceLanguage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Dictionary>
     */
    public function getTranslationDictionaries(): Collection
    {
        return $this->translationDictionaries;
    }

    public function addTranslationDictionary(Dictionary $translationDictionary): static
    {
        if (!$this->translationDictionaries->contains($translationDictionary)) {
            $this->translationDictionaries->add($translationDictionary);
            $translationDictionary->setTranslationLanguage($this);
        }

        return $this;
    }

    public function removeTranslationDictionary(Dictionary $translationDictionary): static
    {
        if ($this->translationDictionaries->removeElement($translationDictionary)) {
            // set the owning side to null (unless already changed)
            if ($translationDictionary->getTranslationLanguage() === $this) {
                $translationDictionary->setTranslationLanguage(null);
            }
        }

        return $this;
    }
}
