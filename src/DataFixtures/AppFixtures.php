<?php

namespace App\DataFixtures;

use App\Entity\Allergen;
use App\Entity\Ingredient;
use App\Entity\Recette;
use App\Entity\Regime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        $ingredients = [];
        $allergens=[];
        $regimes=[];
        for ($j=0; $j<8;$j++){
            $allergen = new Allergen();
            $allergen->setName($faker->word());
            $allergens[]=$allergen;
            $manager->persist($allergen);

            $regime = new Regime();
            $regime->setName($faker->word());
            $regimes[]=$regime;
            $manager->persist($regime);

            $ingredient = new Ingredient();
            $ingredient->setName($faker->word());
            $ingredients[] = $ingredient;
            $manager->persist($ingredient);

        }
        for ($i=0; $i<10; $i++){
            $recette= new Recette();
            $recette->setTitle($faker->word())
                ->setDescription($faker->paragraph(rand(5,15)))
                ->setPreparationTime($faker->randomFloat(2, 0, 3))
                ->setCuissonTime($faker->randomFloat(2, 0, 3))
                ->setEtapes($faker->paragraph(rand(3,12)))
                ->setNote($faker->numberBetween(1, 5))
                ->setReposTime($faker->randomFloat(2, 0, 3));
            for ($z=0;$z<5;$z++){
                $recette->addIngredient($ingredients[rand(1,7)])
                    ->addAllergen($allergens[rand(1,7)])
                    ->addRegime($regimes[rand(1,7)]);
            }

            $manager->persist($recette);
        }


            $manager->flush();

    }
}
