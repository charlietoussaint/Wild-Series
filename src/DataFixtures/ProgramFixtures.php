<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        ['Title' => 'Fargo', 'Synopsis' => 'Lorne Malvo est un poti rigolo', 'category' => 'Action'],
        ['Title' => 'Game of Thrones', 'Synopsis' => 'Cersei the queen', 'category' => 'Action'],
        ['Title' => 'Black Mirror', 'Synopsis' => 'Once a dystopia, now a documentary', 'category' => 'Action'],
        ['Title' => 'Malcolm', 'Synopsis' => 'A dysfunctionnal family in the american suburbs', 'category' => 'Action'],
        ['Title' => 'Breaking Bad', 'Synopsis' => 'Same as Malcolm', 'category' => 'Action']
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $key => $tvshow) {
        $program = new Program();
        $program->setTitle($tvshow['Title']);
        $program->setSynopsis($tvshow['Synopsis']);
        $program->setCategory($this->getReference('category_' . $tvshow['category']));
        $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}

