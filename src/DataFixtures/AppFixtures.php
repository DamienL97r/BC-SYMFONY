<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Service;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const NB_ARTICLE = 10;
    private const NB_SERVICE = 10;
    private const NB_USER = 10;
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = \Faker\Factory::create();

        $userAdmin = new User();
        $userAdmin ->setEmail('test@test.com')
        ->setRoles(['ROLE_ADMIN'])
        ->setPassword('$2y$13$EsOwp.LhsUooZUyBn/w/8OJGSiAEhLC7LQfNBPY2MHERvSDE8GRpm') # test | admin
        ->setFirstname('John')
        ->setLastname('Doe')
        ->setBirthdate($faker->dateTimeBetween('-5 years'))
        ->setGender('Homme')
        ->setAdresse($faker->address());
        $manager->persist($userAdmin);

        for ($i = 0; $i < self::NB_USER; $i++) {
            $user = new User();
            $user->setEmail($faker->email())
            ->setRoles(['ROLE_USER'])
            ->setPassword('$2y$13$IZNvPiBtZlB19ITDbpAun.FCAEKyOzENzhJXF2LE584WxD/PLsVgu') # password: user
            ->setFirstname($faker->firstName())
            ->setLastname($faker->lastName())
            ->setBirthdate($faker->dateTimeBetween('-5 years'))
            ->setGender($faker->randomElement(['Homme', 'Femme', 'Non genrée']))
            ->setAdresse($faker->address());
            $manager->persist($user);
          }

        for ($i = 0; $i < self::NB_ARTICLE; $i++) {
          $article = new Article();
          $article->setName($faker->realText(10))
            ->setPrice($faker->randomFloat(2, 0, 70))
            ->setDescription($faker->realTextBetween(250, 500));
          $manager->persist($article);
        }

        for ($i = 0; $i < self::NB_SERVICE; $i++) {
            $service = new Service();
            $service->setName($faker->realText(10))
              ->setPrice($faker->randomFloat(2, 0, 50))
              ->setDescription($faker->realTextBetween(250, 500));
            $manager->persist($service);
          }

        $manager->flush();
    }
}
