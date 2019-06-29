<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayerRepository")
 */
class Player
{
    const AVATAR_PIC = [
        'female' => [
            'none' => 'etudiante.png',
            'glass' => 'etudiantealunette.png',
            'glassdental' => 'femmedentlunette.png',
            'dental' => 'femmedent.png',
            'doctor' => 'etudiantemalade.png',
        ],
        'male' => [
            'none' => 'etudiant-1.png',
            'glass' => 'etudiantlunette.png',
            'glassdental' => 'hommedentlunette.png',
            'dental' => 'hommedent2.png',
            'doctor' => 'etudiantmalade.png',

        ],
        'transgender' => [
            'none' => 'etudiant-1.png',
            'glass' => 'etudiantealunette.png',
            'glassdental' => 'hommedentlunette.png',
            'dental' => 'femmedent.png',
            'doctor' => 'etudiantmalade.png',
        ],
    ];
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Status", inversedBy="players")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gender;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="boolean")
     */
    private $haveGlasses;

    /**
     * @ORM\Column(type="boolean")
     */
    private $haveDentalCare;

    /**
     * @ORM\Column(type="integer")
     */
    private $doctorVisitFrequency;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @ORM\Column(type="float")
     */
    private $cashBack;

    /**
     * @ORM\Column(type="float")
     */
    private $cashbackInit;

    public function __construct()
    {
        $this->haveGlasses = false;
        $this->haveDentalCare = false;
        $this->doctorVisitFrequency = 0;
        $this->gender = 'male';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getHaveGlasses(): ?bool
    {
        return $this->haveGlasses;
    }

    public function setHaveGlasses(bool $haveGlasses): self
    {
        $this->haveGlasses = $haveGlasses;

        return $this;
    }

    public function getHaveDentalCare(): ?bool
    {
        return $this->haveDentalCare;
    }

    public function setHaveDentalCare(bool $haveDentalCare): self
    {
        $this->haveDentalCare = $haveDentalCare;

        return $this;
    }

    public function getDoctorVisitFrequency(): ?int
    {
        return $this->doctorVisitFrequency;
    }

    public function setDoctorVisitFrequency(int $doctorVisitFrequency): self
    {
        $this->doctorVisitFrequency = $doctorVisitFrequency;

        return $this;
    }

    public function getPicture(): ?string
    {
        switch ($this->gender) {
            case 'male':
                switch (true) {
                    case $this->getHaveGlasses() && !$this->getHaveDentalCare() :
                        $this->picture = self::AVATAR_PIC[$this->gender]['glass'];
                        break;
                    case !$this->getHaveGlasses() && $this->getHaveDentalCare():
                        $this->picture = self::AVATAR_PIC[$this->gender]['dental'];
                        break;
                    case $this->getHaveGlasses() && $this->getHaveDentalCare():
                        $this->picture = self::AVATAR_PIC[$this->gender]['glassdental'];
                        break;
                    case $this->getDoctorVisitFrequency()>0:
                        $this->picture = self::AVATAR_PIC[$this->gender]['doctor'];
                        break;
                    default:
                        $this->picture = self::AVATAR_PIC[$this->gender]['none'];
                        break;
                }
                break;
            case 'female':
                switch (true) {
                    case $this->getHaveGlasses() && !$this->getHaveDentalCare() :
                        $this->picture = self::AVATAR_PIC[$this->gender]['glass'];
                        break;
                    case !$this->getHaveGlasses() && $this->getHaveDentalCare():
                        $this->picture = self::AVATAR_PIC[$this->gender]['dental'];
                        break;
                    case $this->getHaveGlasses() && $this->getHaveDentalCare():
                        $this->picture = self::AVATAR_PIC[$this->gender]['glassdental'];
                        break;
                    case $this->getDoctorVisitFrequency()>0:
                        $this->picture = self::AVATAR_PIC[$this->gender]['doctor'];
                        break;
                    default:
                        $this->picture = self::AVATAR_PIC[$this->gender]['none'];
                        break;
                }
                break;
            case 'transgender':
                switch (true) {
                    case $this->getHaveGlasses() && !$this->getHaveDentalCare() :
                        $this->picture = self::AVATAR_PIC[$this->gender]['glass'];
                        break;
                    case !$this->getHaveGlasses() && $this->getHaveDentalCare():
                        $this->picture = self::AVATAR_PIC[$this->gender]['dental'];
                        break;
                    case $this->getHaveGlasses() && $this->getHaveDentalCare():
                        $this->picture = self::AVATAR_PIC[$this->gender]['glassdental'];
                        break;
                    case $this->getDoctorVisitFrequency()>0:
                        $this->picture = self::AVATAR_PIC[$this->gender]['doctor'];
                        break;
                    default:
                        $this->picture = self::AVATAR_PIC[$this->gender]['none'];
                        break;
                }
                break;
        }

        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getCashBack(): ?float
    {
        return $this->cashBack;
    }

    public function setCashBack(float $cashBack): self
    {
        $this->cashBack = $cashBack;

        return $this;
    }

    public function getCashbackInit(): ?float
    {
        return $this->cashbackInit;
    }

    public function setCashbackInit(float $cashbackInit): self
    {
        $this->cashbackInit = $cashbackInit;

        return $this;
    }
}
