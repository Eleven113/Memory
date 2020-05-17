<?php
// src/Controller/ScoreController.php

namespace App\Controller;

use App\Entity\Highscore;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/score")
 */
class ScoreController extends AbstractController
{

    /**
     * Route pour afficher les meilleurs scores
     * @Route("/", name="app_score")
     */
    public function index()
    {
        return $this->render('Score/Highscores.html.twig');
    }

    /**
     * Route pour récupérer les meilleurs scores
     * @Route("/getscore/{difficulty}/{numplayers}", name="app_getscore")
     */
    public function getscore($difficulty, $numplayers)
    {
        $em = $this->getDoctrine()->getManager();
        $highscore = $em->getRepository('App:Highscore');
        $highscore = $highscore->findBy(
            ['difficulty' => $difficulty, 'numplayers' => $numplayers],
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
     * Route pour enregistrer un nouveau score
     * @Route("/setscore/", name="app_setscore")
     */
    public function setscore(Request $request)
    {
        $player = $request->request->get('player');
        $time = $request->request->get('time');
        $try = $request->request->get('try');
        $difficulty = $request->request->get('difficulty');
        $numplayers = $request->request->get('numplayers');
        var_dump($time);
        $em = $this->getDoctrine()->getManager();

        $highscore = new Highscore();
        $highscore->setPlayer($player);
        $highscore->setTime($time);
        $highscore->setDifficulty($difficulty);
        $highscore->setTry($try);
        $highscore->setNumplayers($numplayers);


        $em->persist($highscore);
        $em->flush();

        return new Response(null, Response::HTTP_OK);
    }
}