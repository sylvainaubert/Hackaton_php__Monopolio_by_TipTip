<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatusRepository")
 */
class Status
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Age", mappedBy="status")
     */
    private $age;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Player", mappedBy="status")
     */
    private $players;

    public function __construct()
    {
        $this->age = new ArrayCollection();
        $this->players = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
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
     * @return Collection|Age[]
     */
    public function getAge(): Collection
    {
        return $this->age;
    }

    public function addAge(Age $age): self
    {
        if (!$this->age->contains($age)) {
            $this->age[] = $age;
            $age->setStatus($this);
        }

        return $this;
    }

    public function removeAge(Age $age): self
    {
        if ($this->age->contains($age)) {
            $this->age->removeElement($age);
            // set the owning side to null (unless already changed)
            if ($age->getStatus() === $this) {
                $age->setStatus(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->setStatus($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->contains($player)) {
            $this->players->removeElement($player);
            // set the owning side to null (unless already changed)
            if ($player->getStatus() === $this) {
                $player->setStatus(null);
            }
        }

        return $this;
    }
}
