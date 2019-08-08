<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class AnswerController extends AbstractController
{
    private $normalizer;
    
    public function __construct(NormalizerInterface $normalizer)
    {
        $this->normalizer = $normalizer;
    }
    
    /**
     * @Route("/answers", name="answers", methods={"GET"})
     * @Route("/answer/list", name="answer_list", methods={"GET"})
     */
    public function list()
    {
        $answers = $this
            ->getDoctrine()
            ->getRepository(\App\Entity\Answer::class)
            ->findAll();
        
        return $this->json(
            $this->normalizer->normalize(
                $answers, 
                null, 
                [
                    'groups' => ['base']
                ]
            )
        );
    }
    
    /**
     * @Route("/answer/{id}", name="answer_detail", methods={"GET"})
     */
    public function detail($id)
    {
        $answer = $this
            ->getDoctrine()
            ->getRepository(\App\Entity\Answer::class)
            ->find($id);
        
        return $this->json(
            $this->normalizer->normalize(
                $answer, 
                null, 
                [
                    'groups' => ['base', 'with_question', 'with_votes']
                ]
            )
        );
    }
    
    /**
     * @Route("/answer/add", name="answer_add", methods={"POST"})
     */
    public function add()
    {
        return $this->json(["answer add route"]);
    }
}
