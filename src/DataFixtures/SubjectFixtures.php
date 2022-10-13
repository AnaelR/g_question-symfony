<?php

namespace App\DataFixtures;

use App\Entity\Subject;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\ManagerRegistry;

class SubjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $subject = new Subject();
        $subject->setContent('Coucou je suis le contenu');
        $subject->setTitle('Je suis la question ?');
        $subject->setOwner($this->getReference(UserFixtures::NORMAL_USER));
        $subject->setStatus(false);

        $manager->persist($subject);

        $manager->flush();
    }
}
