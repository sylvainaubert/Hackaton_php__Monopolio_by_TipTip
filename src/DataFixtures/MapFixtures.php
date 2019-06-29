<?php

namespace App\DataFixtures;

use App\Entity\Map;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MapFixtures extends Fixture
{
    const MAPS = [
        [
            'width' => 12,
            'height' => 12,
            'backgroundpicture' => 'img.jpg',
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::MAPS as $key => $mapValue) {
            $map = new Map();
            $map->setWidth($mapValue['width']);
            $map->setHeight($mapValue['height']);
            $map->setBackgroundPicture($mapValue['backgroundpicture']);
            $this->addReference('map' . $key, $map);
            $manager->persist($map);
        }
        $manager->flush();
    }
}
