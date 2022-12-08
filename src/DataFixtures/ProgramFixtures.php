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
        ['Title' => 'Breaking Bad', 'Synopsis' => 'Same as Malcolm', 'category' => 'Action'],
        ['Title' => 'Arcane', 'Synopsis' => 'LOL en série', 'category' => 'Action']
    ];

    public function load(ObjectManager $manager)
    {
        // foreach (self::PROGRAMS as $key => $tvshow) {
        //     $program = new Program();
        //     $program->setTitle($tvshow['Title']);
        //     $program->setSynopsis($tvshow['Synopsis']);
        //     $program->setCategory($this->getReference('category_' . $tvshow['category']));
        //     $manager->persist($program);
        //     $this->addReference('program_' . $key, $program);
        // }

        $program1 = new Program();
        $program1->setTitle('Fargo');
        $program1->setCountry('Etats-Unis');
        $program1->setYear(2012);
        $program1->setSynopsis("Lorne Malvo le poti rigolo");
        $program1->setCategory($this->getReference('category_Action'));
        $program1->setPoster("01.jpg");
        $manager->persist($program1);
        $this->addReference("program_1", $program1);

        $program2 = new Program();
        $program2->setTitle('Game of Thrones');
        $program2->setCountry('Etats-Unis');
        $program2->setYear(2012);
        $program2->setSynopsis("Trahison et intrigues");
        $program2->setCategory($this->getReference('category_Action'));
        $program2->setPoster("02.jpg");
        $manager->persist($program2);
        $this->addReference("program_2", $program2);

        $program3 = new Program();
        $program3->setTitle('Black Mirror');
        $program3->setCountry('Angleterre');
        $program3->setYear(2012);
        $program3->setSynopsis("D'abord une dystopie, maintenant un documentaire");
        $program3->setCategory($this->getReference('category_Action'));
        $program3->setPoster("03.jpg");
        $manager->persist($program3);
        $this->addReference("program_3", $program3);

        $program4 = new Program();
        $program4->setTitle('Malcolm');
        $program4->setCountry('Etats-Unis');
        $program4->setYear(2012);
        $program4->setSynopsis("Une famille dans les suburbs");
        $program4->setCategory($this->getReference('category_Action'));
        $program4->setPoster("04.jpg");
        $manager->persist($program4);
        $this->addReference("program_4", $program4);

        $program5 = new Program();
        $program5->setTitle('Breaking Bad');
        $program5->setCountry('Etats-Unis');
        $program5->setYear(2012);
        $program5->setSynopsis("Une famille dans les suburbs");
        $program5->setCategory($this->getReference('category_Action'));
        $program5->setPoster("05.jpg");
        $manager->persist($program5);
        $this->addReference("program_5", $program5);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
