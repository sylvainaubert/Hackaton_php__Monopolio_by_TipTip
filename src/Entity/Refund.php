<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RefundRepository")
 */
class Refund
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $benefit;

    /**
     * @ORM\Column(type="float")
     */
    private $regulatedPrice;

    /**
     * @ORM\Column(type="float")
     */
    private $basicRefund;

    /**
     * @ORM\Column(type="integer")
     */
    private $refundRate;

    /**
     * @ORM\Column(type="integer")
     */
    private $RefundRateTipTip;

    /**
     * @ORM\Column(type="boolean")
     */
    private $secuSupported;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Loose", mappedBy="refunds")
     */
    private $looses;



    public function __construct()
    {
        $this->looses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBenefit(): ?string
    {
        return $this->benefit;
    }

    public function setBenefit(string $benefit): self
    {
        $this->benefit = $benefit;

        return $this;
    }

    public function getRegulatedPrice(): ?float
    {
        return $this->regulatedPrice;
    }

    public function setRegulatedPrice(float $regulatedPrice): self
    {
        $this->regulatedPrice = $regulatedPrice;

        return $this;
    }

    public function getBasicRefund(): ?float
    {
        return $this->basicRefund;
    }

    public function setBasicRefund(float $basicRefund): self
    {
        $this->basicRefund = $basicRefund;

        return $this;
    }

    public function getRefundRate(): ?int
    {
        return $this->refundRate;
    }

    public function setRefundRate(int $refundRate): self
    {
        $this->refundRate = $refundRate;

        return $this;
    }

    public function getRefundRateTipTip(): ?int
    {
        return $this->RefundRateTipTip;
    }

    public function setRefundRateTipTip(int $RefundRateTipTip): self
    {
        $this->RefundRateTipTip = $RefundRateTipTip;

        return $this;
    }

    public function getSecuSupported(): ?bool
    {
        return $this->secuSupported;
    }

    public function setSecuSupported(bool $secuSupported): self
    {
        $this->secuSupported = $secuSupported;

        return $this;
    }

    /**
     * @return Collection|Loose[]
     */
    public function getLooses(): Collection
    {
        return $this->looses;
    }

    public function addLoose(Loose $loose): self
    {
        if (!$this->looses->contains($loose)) {
            $this->looses[] = $loose;
            $loose->addRefund($this);
        }

        return $this;
    }

    public function removeLoose(Loose $loose): self
    {
        if ($this->looses->contains($loose)) {
            $this->looses->removeElement($loose);
            $loose->removeRefund($this);
        }

        return $this;
    }

}
