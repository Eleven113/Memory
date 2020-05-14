<?php
// src/Controller/ScoreController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/game")
 */
class ScoreController extends AbstractController
{

    /**
     * @Route("/score", name="app_score")
     */
    public function index()
    {
        return $this->render('Score/Highscores.html.twig');
    }
}