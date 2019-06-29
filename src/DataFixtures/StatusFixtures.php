<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $status = new Status();
        $status->setName('etudiant');
        $status->setImage('status_etudiant.jpg');
        $manager->persist($status);
        $this->addReference('etudiant', $status);

        $status = new Status();
        $status->setName('freelance');
        $status->setImage('status_freelance.jpg');
        $manager->persist($status);
        $this->addReference('freelance', $status);

        $manager->flush();

    }
}
