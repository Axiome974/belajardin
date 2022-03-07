<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    const DEFAULT_PASSWORD = "123456";

    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * @var UserPasswordHasherInterface
     */
    private $hasher;

    /**
     * @param UserPasswordHasherInterface $hasher
     */
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->faker = Factory::create();
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {

        for( $i = 0; $i < 10; $i++ ) {
            $manager->persist($this->createUser());
        }
        for( $i = 0; $i < 10; $i++ ) {
            $manager->persist($this->createUser(true));
        }

        $manager->flush();
    }

    public function createUser( $isAdmin = false ){
        $user = new User();
        $user->setEmail( $this->faker->email );
        $user->setPassword( $this->hasher->hashPassword($user, self::DEFAULT_PASSWORD));
        if( $isAdmin ){
            $user->setRoles(["ROLE_ADMIN"]);
        }
        return $user;
    }
}
