<?php
// src/Controller/GameController.php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Memory\Memory;

/**
 * @Route("/game")
 */
class GameController extends AbstractController
{
    private $session;

    /**
     * GameController constructor.
     * @param $session
     */

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/newgame", name="app_newgame")
     */
    public function index()
    {
        return $this->render('Game/NewGame.html.twig');
    }

    /**
     * @Route("/", name="app_game")
     * @param Request $request
     * @return Response
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
        $memory = new Memory($size, $names, $theme);
        $this->session->set('memory', $memory);
        return $this->render('Game/Game.html.twig',
            ['players' => $memory->getPlayers(),
            'player' => $memory->getPlayer(),
            'theme' => $theme,
            'size' => $size,
            'cards' => $memory->getCards()]);
    }

    /**
     * @Route("/play/{i}", name="app_play", requirements= { "i"  = "\d+"})
     * @param $i
     * @return Response
     */
    public function play($i)
    {
        $memory = $this->session->get('memory');
        if ($i < 0 || $i >= $memory->getSize()) {
            $response = new Response('Incorrect value for parameter "i"', Response::HTTP_BAD_REQUEST);
        } else {
            $playResponse = $memory->play($i);
            $response = new JsonResponse($playResponse);
        }
        return $response;
    }
}