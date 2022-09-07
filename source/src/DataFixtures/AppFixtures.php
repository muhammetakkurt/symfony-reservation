<?php

namespace App\DataFixtures;

use App\Entity\Place;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $place = new Place();
            $place->setTitle('place '.$i);
            $place->setCreatedAt(new \DateTimeImmutable('now'));
            $manager->persist($place);
        }

        $manager->flush();
    }
}
