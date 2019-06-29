<?php

namespace App\DataFixtures;

use App\Entity\Loose;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LooseFixtures extends Fixture implements DependentFixtureInterface
{
    const LOOSES = [
        [
            'description' => 'cassage de jambe',
            'refunds' => [0, 1, 3],
            'event_categories' => [3, 5, 10, 11],
            'picture' => 'fracture.gif',
        ],
        [
            'description' => 'chlamydiae',
            'refunds' => [6,9,10],
            'event_categories' => [0,2],
            'picture' => 'chlamydiae.gif',
        ],
        [
            'description' => 'carie',
            'refunds' => [12],
            'event_categories' => [4,8,9],
            'picture' => 'carie.gif',
        ],
        [
            'description' => 'lumbago',
            'refunds' => [6,8],
            'event_categories' => [2,6,7,10,11],
            'picture' => 'lumbago.gif',
        ],
        [
            'description' => 'céssité',
            'refunds' => [7],
            'event_categories' => [1,7,8],
            'picture' => 'cessite.gif',
        ],
        [
            'description' => 'dent cassée',
            'refunds' => [7,17],
            'event_categories' => [5,7,11],
            'picture' => 'dentcasse.gif',
        ],
        [
            'description' => 'gastro',
            'refunds' => [6,10],
            'event_categories' => [4,8],
            'picture' => 'diarrhee.gif',
        ],
        [
            'description' => 'beaugossisation',
            'refunds' => [11],
            'event_categories' => [0,2],
            'picture' => 'beaugosse.gif',
        ],
        [
            'description' => 'entorse',
            'refunds' => [0,1],
            'event_categories' => [3,5,6,7,8,11],
            'picture' => 'entorse.gif',
        ],
        [
            'description' => 'multiple fractures',
            'refunds' => [0,1,3],
            'event_categories' => [3,5,6,7,8,10,11],
            'picture' => 'multiplesfra.gif',
        ],
        [
            'description' => 'coma éthylique',
            'refunds' => [0,1,3],
            'event_categories' => [0,4,8,9],
            'picture' => 'comaethylique.gif',
        ],
        [
            'description' => 'arcade sourcillière',
            'refunds' => [1,8,10],
            'event_categories' => [2,5,7,10,11],
            'picture' => 'plaie.gif',
        ],
        [
            'description' => 'intoxication alimentaire',
            'refunds' => [0,1,3,10],
            'event_categories' => [4,6,9],
            'picture' => 'intoxication.gif',
        ],

    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::LOOSES as $key => $looseValue) {
            $loose = new Loose();
            $loose->setDescription($looseValue['description']);
            $loose->setPicture($looseValue['picture']);
            foreach ($looseValue['refunds'] as $keyRefund => $refundValue) {
                $loose->addRefund($this->getReference('refund' . $refundValue));

            }
            foreach ($looseValue['event_categories'] as $keyEventCategory => $EventCategoryValue) {
                $loose->addEventCategory($this->getReference('event_category' . $EventCategoryValue));
            }
            $this->addReference('loose' . $key, $loose);
            $manager->persist($loose);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            RefundFixtures::class,
            EventCategoryFixtures::class,
        ];
    }
}
