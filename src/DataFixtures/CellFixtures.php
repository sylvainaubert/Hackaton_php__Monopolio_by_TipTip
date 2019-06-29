<?php

namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use App\Entity\Cell;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CellFixtures extends Fixture  implements DependentFixtureInterface
{
    const CELLS_MAP = [
        ['coordX' => 1, 'coordY' => 1,],
        ['coordX' => 2, 'coordY' => 1,],
        ['coordX' => 2, 'coordY' => 2,],
        ['coordX' => 2, 'coordY' => 3,],
        ['coordX' => 3, 'coordY' => 3,],
        ['coordX' => 4, 'coordY' => 3,],
        ['coordX' => 5, 'coordY' => 3,],
        ['coordX' => 5, 'coordY' => 4,],
        ['coordX' => 6, 'coordY' => 4,],
        ['coordX' => 7, 'coordY' => 4,],
        ['coordX' => 8, 'coordY' => 4,],
        ['coordX' => 9, 'coordY' => 4,],
        ['coordX' => 10, 'coordY' => 4,],
        ['coordX' => 11, 'coordY' => 4,],
        ['coordX' => 11, 'coordY' => 5,],
        ['coordX' => 11, 'coordY' => 6,],
        ['coordX' => 10, 'coordY' => 6,],
        ['coordX' => 9, 'coordY' => 6,],
        ['coordX' => 8, 'coordY' => 6,],
        ['coordX' => 7, 'coordY' => 6,],
        ['coordX' => 6, 'coordY' => 6,],
        ['coordX' => 5, 'coordY' => 6,],
        ['coordX' => 4, 'coordY' => 6,],
        ['coordX' => 3, 'coordY' => 6,],
        ['coordX' => 3, 'coordY' => 7,],
        ['coordX' => 2, 'coordY' => 7,],
        ['coordX' => 2, 'coordY' => 8,],
        ['coordX' => 2, 'coordY' => 9,],
        ['coordX' => 3, 'coordY' => 9,],
        ['coordX' => 4, 'coordY' => 9,],
        ['coordX' => 5, 'coordY' => 9,],
        ['coordX' => 5, 'coordY' => 8,],
        ['coordX' => 6, 'coordY' => 8,],
        ['coordX' => 7, 'coordY' => 8,],
        ['coordX' => 7, 'coordY' => 9,],
        ['coordX' => 8, 'coordY' => 9,],
        ['coordX' => 8, 'coordY' => 10,],
        ['coordX' => 9, 'coordY' => 10,],
        ['coordX' => 10, 'coordY' => 10,],
        ['coordX' => 11, 'coordY' => 10,],
        ['coordX' => 11, 'coordY' => 11,],
        ['coordX' => 11, 'coordY' => 12,],
        ['coordX' => 12, 'coordY' => 12,],
    ];

    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        foreach (self::CELLS_MAP as $key => $cellValue) {
            $cell = new Cell();
            $cell->setPosition($key+1);
            $cell->setCoordX($cellValue['coordX']);
            $cell->setCoordY($cellValue['coordY']);
            if ($faker->numberBetween(0, 10) > 6) {
                $cell->setEventCategory($this->getReference('event_category' . $faker->numberBetween(0, 11)));
            }
            $cell->setMap($this->getReference('map0'));

            $manager->persist($cell);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            EventCategoryFixtures::class,
            MapFixtures::class,
        ];
    }
}
