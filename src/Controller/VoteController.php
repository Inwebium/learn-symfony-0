<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class VoteController extends AbstractController
{
    private $normalizer;
    
    public function __construct(NormalizerInterface $normalizer)
    {
        $this->normalizer = $normalizer;
    }
    
    /**
     * @Route("/votes", name="votes", methods={"GET"})
     * @Route("/vote/list", name="vote_list", methods={"GET"})
     */
    public function list()
    {
        $votes = $this
            ->getDoctrine()
            ->getRepository(\App\Entity\Vote::class)
            ->findAll();
        
        return $this->json(
            $this->normalizer->normalize(
                $votes, 
                null, 
                [
                    'groups' => ['base']
                ]
            )
        );
    }
    
    /**
     * @Route("/vote/{id}", name="vote_detail", methods={"GET"})
     */
    public function detail($id)
    {
        $vote = $this
            ->getDoctrine()
            ->getRepository(\App\Entity\Vote::class)
            ->find($id);
        
        return $this->json(
            $this->normalizer->normalize(
                $vote, 
                null, 
                [
                    'groups' => ['base']
                ]
            )
        );
    }
    
    /**
     * @Route("/vote/add", name="vote_add", methods={"POST"})
     */
    public function add()
    {
        return $this->json(["vote add route"]);
    }
}
