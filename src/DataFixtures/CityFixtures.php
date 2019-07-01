<?php

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $city1 =new City();
        $city1->setName("Bruxelle");
        $manager->persist($city1);
        $this->setReference("city-Bruxelles", $city1);

        $city2 =new City();
        $city2->setName("Anger");
        $manager->persist($city1);
        $this->setReference("city-Anger", $city2);

        $city3 =new City();
        $city3->setName("Rennes");
        $manager->persist($city1);
        $this->setReference("city-Rennes", $city3);

        $city4 =new City();
        $city4->setName("Bordeaux");
        $manager->persist($city1);
        $this->setReference("city-Bordeaux", $city4);

        $manager->flush();
    }
}
