<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class QuestionFixtures extends Fixture implements \Doctrine\Common\DataFixtures\DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userRepository = $manager->getRepository(\App\Entity\User::class);
        $questions = [
            [
                'text' => 'Foo or Bar?',
                'endsAt' => new \DateTime('2019-12-31'),
                'author' => 'first',
                'answers' => [
                    [
                        'text' => 'Foo',
                        'votes' => [
                            
                        ]
                    ],
                    [
                        'text' => 'Bar',
                        'votes' => [
                            
                        ]
                    ],
                    [
                        'text' => 'Lorem ipsum',
                        'votes' => [
                            
                        ]
                    ]
                ]
            ],
            [
                'text' => 'Round or Flat?',
                'endsAt' => new \DateTime('2019-08-01'),
                'author' => 'second',
                'answers' => [
                    [
                        'text' => 'Round',
                        'votes' => [
                            
                        ]
                    ],
                    [
                        'text' => 'Flat',
                        'votes' => [
                            
                        ]
                    ],
                    [
                        'text' => 'Thicc',
                        'votes' => [
                            
                        ]
                    ]
                ]
            ],
            [
                'text' => 'Liquid or Solid?',
                'endsAt' => new \DateTime('2019-09-25'),
                'author' => 'third',
                'answers' => [
                    [
                        'text' => 'Foo',
                        'votes' => [
                            
                        ]
                    ],
                    [
                        'text' => 'Bar',
                        'votes' => [
                            
                        ]
                    ]
                ]
            ],
            [
                'text' => 'Black or White?',
                'endsAt' => new \DateTime('2019-08-31'),
                'author' => 'third',
                'answers' => [
                    [
                        'text' => 'Black',
                        'votes' => [
                            
                        ]
                    ],
                    [
                        'text' => 'White',
                        'votes' => [
                            
                        ]
                    ]
                ]
            ],
        ];
        
        array_walk($questions, function(&$element, $questionKey) use ($manager) {
            $newQuestion = new \App\Entity\Question();
            $newQuestion
                ->setText($element['text'])
                ->setEndsAt($element['endsAt'])
                ->setAuthor($this->getReference($element['author']))
            ;
            
            array_walk($element['answers'], function(&$answer, $answerKey) use ($newQuestion, $manager) {
                $newAnswer = new \App\Entity\Answer(
                    $answer['text'], 
                    $newQuestion
                );
                
                $manager->persist($newAnswer);
            });
            
            $manager->persist($newQuestion);
        });
        
        

        $manager->flush();
    }
    
    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}
