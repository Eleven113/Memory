<?php
// src/Controller/MenuController.php

namespace App\Controller;

use App\Entity\Highscore;
use App\Entity\Score;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    /**
     * Route pour afficher le menu
     * @Route("/", name="app_menu")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $highscore = $em->getRepository('App:Highscore');
        $highscore = $highscore->findBy(
            ['difficulty' => 'easy', 'numplayers' => 1],
            ['try' => 'ASC' , 'time' => 'ASC'],
            10,
            0
        );

        return $this->render('Menu/menu.html.twig', ['highscore' => $highscore]);
    }

}
