<?php

namespace App\DataFixtures;

use App\Entity\Age;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AgeFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies()
    {
        return [StatusFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $age = new Age();
        $age->setStatus($this->getReference('etudiant'));
        $age->setAge('moins de 22 ans');
        $age->setPrice(20);
        $manager->persist($age);

        $age = new Age();
        $age->setStatus($this->getReference('etudiant'));
        $age->setAge('entre 22 ans et 25 ans');
        $age->setPrice(23);
        $manager->persist($age);

        $age = new Age();
        $age->setStatus($this->getReference('etudiant'));
        $age->setAge('plus de 26 ans');
        $age->setPrice(28);
        $manager->persist($age);

        $age = new Age();
        $age->setStatus($this->getReference('freelance'));
        $age->setAge('moins de 30 ans');
        $age->setPrice(20);
        $manager->persist($age);

        $age = new Age();
        $age->setStatus($this->getReference('freelance'));
        $age->setAge('plus de 31 ans');
        $age->setPrice(24);
        $manager->persist($age);

        $manager->flush();
    }
}
