<?php

namespace App\DataFixtures;

use App\Entity\EventCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EventCategoryFixtures extends Fixture
{
    const EVENT_CATEGORIES = [
        [
            'name' => 'Soirée Infirmières',
            'description' => 'Chaude soirée mousse en perspective!! Le stétoscope sera de sortie',
            'icon' =>'fas fa-user-nurse',
            'picture' =>'nursenight.gif',

        ],
        [
            'name' => 'Marathon Jeux Vidéo',
            'description' => 'Les yeux vont chauffer!! Kevin45 à la manette',
            'icon' =>'fas fa-gamepad',
            'picture' =>'gaming.gif',
        ],
        [
            'name' => 'Tinder',
            'description' => 'Rencard prévu au bar et soirée en boîte!! Macuummmbbaaaa',
            'icon' => 'fas fa-kiss-beam',
            'picture' =>'tinder.gif',
        ],
        [
            'name' => 'Chasse Pokemon',
            'description' => 'Courss!!!! Y a MewTwo au coin de la rue',
            'icon' => 'fas fa-dot-circle',
            'picture' =>'pokemon.gif',
        ],
        [
            'name' => 'Repas de Famille',
            'description' => 'Tonton Jacquot va faire touner les serviettes!!! On envoie de la sardine en boîte!!',
            'icon' => 'fas fa-drumstick-bite',
            'picture' =>'repasfamily.gif',
        ],
        [
            'name' => 'Trot\' Tour',
            'description' => 'On met le casque et on envoie du bois!',
            'icon' => 'fas fa-bicycle',
            'picture' =>'trotinette.gif',
        ],
        [
            'name' => 'Déménagement',
            'description' => 'Allez on aide les potes à monter la machine à laver au 5ème étage sans ascenceur!',
            'icon' => 'fas fa-truck-moving',
            'picture' =>'demenagement.gif',
        ],
        [
            'name' => 'Concert Métal',
            'description' => 'Ca va slamer, pogoter..... et dégoupiller de la bières!!',
            'icon' => 'fas fa-hand-rock',
            'picture' =>'showmusic.gif',
        ],
        [
            'name' => 'Bar\'athon',
            'description' => 'Apérrroooooo!!!',
            'icon' => 'fab fa-untappd',
            'picture' =>'drunk.gif',
        ],
        [
            'name' => 'Restaurant entre potes',
            'description' => 'Resto du mois!! Qui a des tickets resto!!',
            'icon' => 'fas fa-hamburger',
            'picture' =>'repasamis.gif',
        ],
        [
            'name' => 'Session travaux',
            'description' => 'Allez je monte une table Ikea! Woouahhh c est quoi cette notice en carton!',
            'icon' => 'fas fa-hammer',
            'picture' =>'travaux.gif',
        ],
        [
            'name' => 'Sport d\'hiver',
            'description' => 'BackFlip, enchainé avec un frontside.... Pousses-toi le chamois!!',
            'icon' => 'fas fa-skiing',
            'picture' =>'ski.gif',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::EVENT_CATEGORIES as $key => $eventCategoryValue) {
            $eventCategory = new EventCategory();
            $eventCategory->setName($eventCategoryValue['name']);
            $eventCategory->setDescription($eventCategoryValue['description']);
            $eventCategory->setIcon($eventCategoryValue['icon']);
            $eventCategory->setPicture($eventCategoryValue['picture']);
            $this->addReference('event_category' . $key, $eventCategory);
            $manager->persist($eventCategory);
        }
        $manager->flush();
    }
}
