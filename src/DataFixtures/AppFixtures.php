<?php

namespace App\DataFixtures;

use App\Entity\Diapositive;
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

        $user = new User();
        $user   ->setEmail("admin@admin.fr")
                ->setPassword( $this->hasher->hashPassword($user, self::DEFAULT_PASSWORD ))
                ->setRoles(["ROLE_ADMIN"]);
        $manager->persist($user);

        for( $i = 0; $i < 10; $i++ ) {
            $manager->persist($this->createUser());
        }
        for( $i = 0; $i < 10; $i++ ) {
            $manager->persist($this->createUser(true));
        }

        for( $i = 1; $i <= 3; $i++ ){
            $manager->persist($this->createDiapo($i));
        }

        $manager->flush();
    }

    /**
     * @param $isAdmin
     * @return User
     */
    public function createUser( $isAdmin = false ): User
    {
        $user = new User();
        $user->setEmail( $this->faker->email );
        $user->setPassword( $this->hasher->hashPassword($user, self::DEFAULT_PASSWORD));
        if( $isAdmin ){
            $user->setRoles(["ROLE_ADMIN"]);
        }
        return $user;
    }


    /**
     * @param int $position
     * @return Diapositive
     */
    public function createDiapo(int $position ): Diapositive
    {
        $diapo = new Diapositive();
        $diapo->setDescription( $this->faker->text );
        $diapo->setTitle( $this->faker->text(50) );
        $diapo->setPosition($position);
        $diapo->setPicture('slide-'.$position.'.jpeg');
        return $diapo;
    }
}
