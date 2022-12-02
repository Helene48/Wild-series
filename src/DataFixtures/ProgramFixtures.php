<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const TITLE = [
        'Walking dead',
        'Indiana Jones',
        'Shreck',
        'Stranger Things',
        'All of us are dead',
    ];

    public const SYNOPSIS = [
        'Des zombies envahissent la Terre',
        'Harrisson Ford joue avec un fouet',
        'La princesse est une ogresse super cool',
        'Eleven est au top',
        'Un virus zombie decime un lycee',
    ];

    public const CATEGORIES = [
        'category_action',
        'category_adventure',
        'category_fantasy',
        'category_horror',
        'category_humour',
    ];

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $program = new Program();
            $program->setTitle(self::TITLE[$i]);
            $program->setSynopsis(self::SYNOPSIS[$i]);
            $program->setCategory($this->getReference(self::CATEGORIES[$i]));
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }

}
