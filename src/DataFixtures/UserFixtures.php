<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    
    public function load(ObjectManager $manager)
    {
        $user1 = new \App\Entity\User();
        
        $user1
            ->setUsername('first')
            ->setPassword($this->passwordEncoder->encodePassword(
                $user1,
                '111qwe'
            ))
        ;
        
        $manager->persist($user1);
        $manager->flush();
        
        $question1_1 = new \App\Entity\Question();
        $question1_1
            ->setText('Foo or Bar?')
            ->setEndsAt(new \DateTime('2019-08-15'))
            ->setAuthor($user1)
        ;
        
        $option1_1 = new \App\Entity\Answer();
        $option1_1->setText('Foo');
        
        $option1_2 = new \App\Entity\Answer();
        $option1_2->setText('Bar');
        
        
        
        $question1_1
            ->addAnswer($option1_1)
            ->addAnswer($option1_2)
        ;
        
        $option1_1->setQuestion($question1_1);
        $option1_2->setQuestion($question1_1);
        
        $manager->persist($question1_1);
        $manager->persist($option1_1);
        $manager->persist($option1_2);
        
        $manager->flush();
    }
}
