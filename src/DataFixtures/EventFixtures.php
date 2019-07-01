<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\Language;
use App\Service\Slugger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class EventFixtures extends Fixture
{
    private $slugger;

    /**
     * EventFixtures constructor.
     * @param $slugger
     */
    public function __construct(Slugger $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager)
    {
        $event1 = new Event();
        $event1->setTitle("West Web Festival");
        $event1->setSlug($this->slugger->slugify($event1->getTitle()));
        $event1->setPicture(null);
        $event1->setCity($this->getReference("city-Rennes"));
        $event1->addLanguage($this->getReference("language-Français"));
        $event1->setDescription("Lorem ipsum... ");
        $event1->setDateStart(new \DateTime("2019-06-22"));
        $event1->setDateEnd(new \DateTime("2019-06-26"));
        $event1->setUrl("https://www.west-web-festival.fr/");
        $event1->setPrice(398);
        $manager->persist($event1);
        $this->setReference("event-West",$event1);

        $event2 = new Event();
        $event2->setTitle("Open Source Summit");
        $event2->setSlug($this->slugger->slugify($event1->getTitle()));
        $event2->setPicture(null);
        $event2->setCity($this->getReference("city-Rennes"));
        $event2->addLanguage($this->getReference("language-Anglais"));
        $event2->setDescription("Lorem ipsum... ");
        $event2->setDateStart(new \DateTime("2019-08-06"));
        $event2->setDateEnd(new \DateTime("2019-08-10"));
        $event2->setUrl("https://www.opensourcesummit.paris/");
        $event2->setPrice(0);
        $manager->persist($event2);
        $this->setReference("event-Open",$event2);

        $event3 = new Event();
        $event3->setTitle("Big Data Paris");
        $event3->setSlug($this->slugger->slugify($event1->getTitle()));
        $event3->setPicture(null);
        $event3->setCity($this->getReference("city-Paris"));
        $event2->addLanguage($this->getReference("language-Français"));
        $event2->addLanguage($this->getReference("language-Anglais"));
        $event3->setDescription("Lorem ipsum... ");
        $event3->setDateStart(new \DateTime("2019-03-15"));
        $event3->setDateEnd(new \DateTime("2019-03-17"));
        $event3->setUrl("https://www.blogdumoderateur.com/evenements/big-data-paris/");
        $event3->setPrice(790);
        $manager->persist($event3);
        $this->setReference("event-Big",$event3);

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            CityFixtures::class,
            UserFixtures::class,
            Language::class
        ];
    }
}