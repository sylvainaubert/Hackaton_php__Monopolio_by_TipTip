<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LooseRepository")
 */
class Loose
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
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\EventCategory", inversedBy="looses")
     */
    private $eventCategories;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Refund", inversedBy="looses")
     */
    private $refunds;


    public function __construct()
    {
        $this->eventCategories = new ArrayCollection();
        $this->refunds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|EventCategory[]
     */
    public function getEventCategories(): Collection
    {
        return $this->eventCategories;
    }

    public function addEventCategory(EventCategory $eventCategory): self
    {
        if (!$this->eventCategories->contains($eventCategory)) {
            $this->eventCategories[] = $eventCategory;
        }

        return $this;
    }

    public function removeEventCategory(EventCategory $eventCategory): self
    {
        if ($this->eventCategories->contains($eventCategory)) {
            $this->eventCategories->removeElement($eventCategory);
        }

        return $this;
    }

    /**
     * @return Collection|Refund[]
     */
    public function getRefunds(): Collection
    {
        return $this->refunds;
    }

    public function addRefund(Refund $refund): self
    {
        if (!$this->refunds->contains($refund)) {
            $this->refunds[] = $refund;
        }

        return $this;
    }

    public function removeRefund(Refund $refund): self
    {
        if ($this->refunds->contains($refund)) {
            $this->refunds->removeElement($refund);
        }

        return $this;
    }

}
