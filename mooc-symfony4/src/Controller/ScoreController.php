<?php
// src/Controller/ScoreController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Flex\Response;

/**
 * @Route("/score")
 */
class ScoreController extends AbstractController
{

    /**
     * @Route("/", name="app_score")
     */
    public function index()
    {
        return $this->render('Score/Highscores.html.twig');
    }

    /**
     * @Route("/getscore/{id}", name="app_getscore", requirements= { "id"  = "\d+"})
     */
    public function getscore($id)
    {
        $em = $this->getDoctrine()->getManager();
        $highscore = $em->getRepository('App:Highscore');
        $highscore = $highscore->findBy(
            ['cardnumb' => $id],
            ['try' => 'ASC' , 'time' => 'ASC'],
            10,
            0
        );

        $result = [];
        $idx = 0;
        foreach ( $highscore as $score){
            $temp = array(
                'player' => $score->getPlayer(),
                'time' => $score->getTime(),
                'try' => $score->getTry()
            );
            $result[$idx++] = $temp;
        }

        return new JsonResponse($result);
    }

    /**
     * @Route("/setscore/", name="app_setscore")
     */
    public function setscore(Request $request)
    {
        
    }
}