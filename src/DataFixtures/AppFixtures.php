<?php

namespace App\DataFixtures;

use App\Entity\Wish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->addWishes($manager);
    }


    private function addWishes(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 50; $i++) {
            $wish = new Wish();
            $wish
                ->setDescription($faker->realText(1000))
                ->setAuthor($faker->firstName)
                ->setTitle($faker->realText(50))
                ->setPublished($faker->boolean(60))
                ->setDateCreated($faker->dateTimeBetween("-2 year"));

            $manager->persist($wish);
        }
        $manager->flush();
    }

}
