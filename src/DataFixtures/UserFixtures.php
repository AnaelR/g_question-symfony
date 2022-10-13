<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    public const NORMAL_USER = User::class;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $normalUser = new User();
        $normalUser->setMail('test@mail.com');
        $normalUser->setUsername('Robert');
        $normalUser->setRoles(['ROLE_ADMIN']);
        $password = $this->hasher->hashPassword($normalUser, 'pass_1234');
        $normalUser->setPassword($password);

        $this->addReference(self::NORMAL_USER, $normalUser);

        $manager->persist($normalUser);
        $manager->flush();
    }
}
