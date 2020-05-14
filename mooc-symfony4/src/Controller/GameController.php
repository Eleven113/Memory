<?php
// src/Controller/GameController.php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Memory\Memory;

/**
 * @Route("/game")
 */
class GameController extends AbstractController
{
    private $memory;
    /**
     * @Route("/newgame", name="app_newgame")
     */
    public function index()
    {
        return $this->render('Game/NewGame.html.twig');
    }

    /**
     * @Route("/", name="app_game")
     */
    public function game(Request $request)
    {
        $username = $request->request->get('username');
        $cardnumb = $request->request->get('cardnumb');
        $theme = $request->request->get('theme');

        $cards = [];
        for ($i =1; $i <= $cardnumb/2; $i++){
            array_push($cards, 'img/'.$theme.'/'.$i.'.png');
            array_push($cards, 'img/'.$theme.'/'.$i.'.png');
        }

        shuffle($cards);
        $this->memory = new Memory();
        return $this->render('Game/Game.html.twig' , [
            'username' => $username,
            'theme' => $theme,
            'cardnumb' => $cardnumb,
            'cards' => $cards]);
    }
}