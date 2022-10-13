<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $normalUser = new User();
        $normalUser->setMail('test@mail.com');
        $normalUser->setUsername('Robert');
        $password = $this->hasher->hashPassword($normalUser, 'pass_1234');
        $normalUser->setPassword($password);

        $manager->persist($normalUser);
        $manager->flush();
    }
}
