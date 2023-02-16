<?php

namespace App\DataFixtures;

use App\Entity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Countries extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $countryNames = ["Germany", "Italy", "Greece"];

        foreach ($countryNames as $countryName) {
            $country = new Entity\Country();
            $country->setName($countryName);
            $manager->persist($country);
        }

        $manager->flush();
    }
}
