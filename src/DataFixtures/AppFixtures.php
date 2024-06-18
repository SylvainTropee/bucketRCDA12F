<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Wish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->addCategories($manager);
        $this->addWishes($manager);
    }


    private function addCategories(ObjectManager $manager){
        $categories = ['Travel & Adventure', 'Sport', 'Entertainment', 'Human Relations', 'Others'];

        foreach ($categories as $category){
            $cat = new Category();
            $cat->setName($category);
            $manager->persist($cat);
        }
        $manager->flush();
    }

    private function addWishes(ObjectManager $manager)
    {
        //accès à un repository depuis l'entitymanager
        $categories = $manager->getRepository(Category::class)->findAll();

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 50; $i++) {
            $wish = new Wish();
            $wish
                ->setDescription($faker->realText(1000))
                ->setAuthor($faker->firstName)
                ->setTitle($faker->realText(50))
                ->setPublished($faker->boolean(60))
                ->setDateCreated($faker->dateTimeBetween("-2 year"))
                ->setCategory($faker->randomElement($categories));

            $manager->persist($wish);
        }
        $manager->flush();
    }

}
