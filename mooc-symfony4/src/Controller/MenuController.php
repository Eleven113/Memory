<?php
// src/Controller/MenuController.php

namespace App\Controller;

use App\Entity\Score;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/menu")
 */
class MenuController extends AbstractController
{
    /**
     * @Route("/", name="app_menu")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $highscores = $em->getRepository('App:Highscore')->findAll();
        return $this->render('Menu/menu.html.twig', ['highscores' => $highscores]);
    }

    /**
     * @Route("/highscore/{cardnumb}", name="app_highscore")
     */
    public function highscore($cardnumb)
    {
        return $this->render('Menu/menu.html.twig');
    }

}
