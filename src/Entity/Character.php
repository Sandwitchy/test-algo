<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterRepository::class)
 */
class Character
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Character::class)
     */
    private $characters;

    /**
     * @ORM\Column(type="integer")
     */
    private $friendshipType;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(self $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters[] = $character;
        }

        return $this;
    }

    public function removeCharacter(self $character): self
    {
        $this->characters->removeElement($character);

        return $this;
    }

    public function getFriendshipType(): ?int
    {
        return $this->friendshipType;
    }

    public function setFriendshipType(int $friendshipType): self
    {
        $this->friendshipType = $friendshipType;

        return $this;
    }
}
