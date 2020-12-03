<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

/**
 * Class UserFixtures
 * @package App\DataFixtures
 */
class UserFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->initAdminAccount());

        $faker = Factory::create();
        for ($i = 0; $i < 20; ++$i) {
            $user = new User();

            $user->setIsActive(1);
            $user->setEmail($faker->email);
            $user->setFirstname($faker->firstName);
            $user->setLastname($faker->lastName);
            $user->setBirthdate($faker->dateTimeBetween('-75 years', '-18 years'));
            $user->setRoles(['ROLE_USER']);
            $user->setPlainPassword('secret');
            $user->setSalary($faker->randomFloat());
            $manager->persist($user);
        }
        $manager->flush();
    }

    /**
     * @return User
     */
    private function initAdminAccount(): User
    {
        $admin = new User();
        $admin->setIsActive(1);
        $admin->setEmail('admin@lygeemo.fr');
        $admin->setFirstname('Tarja');
        $admin->setLastname('Stridy');
        $admin->setBirthdate(new DateTime('1987-02-03'));
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPlainPassword('secret');

        return $admin;
    }
}
