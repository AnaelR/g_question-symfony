<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $comment = new Comment();
        $comment->setOwner($this->getReference(UserFixtures::NORMAL_USER));
        $comment->setContent('Je suis aps trop d\'accord)');
        $comment->setSubject($this->getReference(SubjectFixtures::SUBJECT));
        $comment->setUpvotes(0);

        $manager->persist($comment);

        $manager->flush();
    }
}
