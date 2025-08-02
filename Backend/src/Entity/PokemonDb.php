<?php

namespace App\Entity;

use App\Repository\PokemonDbRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokemonDbRepository::class)]
class PokemonDb
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $pokeApiId = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sprite = null;

    #[ORM\Column(type: 'json')]
    private array $types = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPokeApiId(): ?int
    {
        return $this->pokeApiId;
    }

    public function setPokeApiId(int $pokeApiId): static
    {
        $this->pokeApiId = $pokeApiId;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getSprite(): ?string
    {
        return $this->sprite;
    }

    public function setSprite(?string $sprite): static
    {
        $this->sprite = $sprite;
        return $this;
    }

    public function getTypes(): array
    {
        return $this->types;
    }

    public function setTypes(array $types): static
    {
        $this->types = $types;
        return $this;
    }
}
