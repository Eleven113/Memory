<?php
// src/Controller/MenuController.php

namespace App\Controller;

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
        return $this->render('Menu/menu.html.twig');
    }

}
