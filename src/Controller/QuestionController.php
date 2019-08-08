<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class QuestionController extends AbstractController
{
    private $normalizer;
    
    public function __construct(NormalizerInterface $normalizer)
    {
        $this->normalizer = $normalizer;
    }
    
    /**
     * @Route("/questions", name="questions", methods={"GET"})
     * @Route("/question/list", name="question_list", methods={"GET"})
     */
    public function list()
    {
        $questions = $this
            ->getDoctrine()
            ->getRepository(\App\Entity\Question::class)
            ->findAll();
        
        return $this->json(
            $this->normalizer->normalize(
                $questions, 
                null, 
                [
                    'groups' => ['base']
                ]
            )
        );
    }
    
    /**
     * @Route("/question/{id}", name="question_detail", methods={"GET"})
     */
    public function detail($id)
    {
        $question = $this
            ->getDoctrine()
            ->getRepository(\App\Entity\Question::class)
            ->find($id);
        
        return $this->json(
            $this->normalizer->normalize(
                $question, 
                null, 
                [
                    'groups' => ['base', 'with_answers', 'with_votes']
                ]
            )
        );
    }
    
    /**
     * @Route("/question/add", name="question_add", methods={"POST"})
     */
    public function add()
    {
        return $this->json(["question add route"]);
    }
}
