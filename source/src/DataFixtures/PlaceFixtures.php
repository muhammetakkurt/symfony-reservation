<?php

namespace App\DataFixtures;

use App\Entity\Place;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PlaceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $generator = Factory::create("en_US");
        for ($i = 0; $i < 20; $i++) {
            $place = new Place();
            $place->setTitle($generator->name());
            $place->setPrice($generator->randomFloat(2,1, 1500));
            $place->setLatitude($generator->latitude());
            $place->setLongitude($generator->longitude());
            $place->setCreatedAt(new \DateTimeImmutable('now'));
            $manager->persist($place);
        }

        $manager->flush();
    }
}
