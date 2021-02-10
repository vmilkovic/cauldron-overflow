<?php

namespace App\DataFixtures;

use App\Factory\QuestionFactory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        QuestionFactory::new()->createMany(20);

        QuestionFactory::new()->unpublished()->createMany(5);
    }
}
