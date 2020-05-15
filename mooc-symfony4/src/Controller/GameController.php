<?php
// src/Controller/GameController.php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $size = $request->request->getInt('size');
        $theme = $request->request->get('theme');
        $players = $request->request->getInt('players');
        $username1 = $request->request->get('username1');
        $names = [$username1];
        if ($players == 2) {
            $username2 = $request->request->get('username2');
            array_push($names, $username2);
        }
        $this->memory = new Memory($size, $names, $theme);
        return $this->render('Game/Game.html.twig',
            ['players' => $this->memory->getPlayers(),
            'player' => $this->memory->getPlayer(),
            'theme' => $theme,
            'size' => $size,
            'cards' => $this->memory->getCards()]);
    }

    /**
     * @Route("/play/{i}", name="app_play", requirements= { "i"  = "\d+"})
     * @param $i
     * @param Memory $memory
     * @return JsonResponse
     */
    public function play($i, Memory $memory)
    {
        $playResponse = $memory->play($i);
        return new JsonResponse($playResponse);
    }
}