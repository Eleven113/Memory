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
        $size = $request->request->get('size');
        $theme = $request->request->get('theme');
        $players = $request->request->get('players');
        $username1 = $request->request->get('username1');
        $names = [$username1];
        if ($players == 2) {
            $username2 = $request->request->get('username2');
            array_push($names, $username2);
        }
//        $cards = [];
//        for ($i =1; $i <= $cardnumb/2; $i++){
//            array_push($cards, 'img/'.$theme.'/'.$i.'.png');
//            array_push($cards, 'img/'.$theme.'/'.$i.'.png');
//        }
//
//        shuffle($cards);
        $this->memory = new Memory($size, $names, $theme);
        return $this->render('Game/Game.html.twig' , ['memory' => $this->memory]);
//            'username' => $username,
//            'theme' => $theme,
//            'cardnumb' => $cardnumb,
//            'cards' => $cards]);
    }
}