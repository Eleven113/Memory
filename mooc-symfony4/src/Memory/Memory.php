<?php


namespace App\Memory;


class Memory
{
    private $size;
    private $players;
    private $symbols = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    private $cards;
    private $player;
    private $currentPair;
    private $isGameOver;
    private $winner;
    private $theme;

    /**
     * Memory constructor.
     * @param $size
     */
    public function __construct($size, $names, $theme)
    {
        $this->players = [];
        $this->players = array_map(function ($name) {
            return new Player($name);
        }, $names);
        $this->player = 0;
        $this->size = $size;
        $this->cards = $this->generateCards($size);
        $this->isGameOver = false;
        $this->theme = $theme;
    }

    private function generateCards($size)
    {
        $candidates = str_split($this->symbols, 1);
        shuffle($candidates);
        $selectedSymbols = [];
        for ($i = 0; $i < $size * $size - 1; $i++) {
            $symbol = $candidates[0];
            $candidates = array_slice($candidates,1);
            array_push($selectedSymbols, $symbol, $symbol);
        }
        return shuffle($selectedSymbols);
    }

    private function nextPlayer() {
        if ($this->player == count($this->players - 1)) {
            $this->player = 0;
        } else $this->player++;
    }

    public function play($i) {
        if (count($this->currentPair) == 2 || $this->cards[$i]->status == "visible") {
            return;
        }
        if (count($this->currentPair) == 0) {
            array_push($this->currentPair,$this->cards[$i]);
            $this->currentPair[0]->status = "visible";
            return;
        }
        $this->handleNewPair($i);
        }

    private function handleNewPair($i)
    {
        array_push($this->currentPair,$this->cards[$i]);
        $this->currentPair[1]->status = "visible";
        $matched = ($this->currentPair[0]->symbol == $this->currentPair[1]->symbol);
        if ($matched) {
            $currentPlayer = $this->players[$this->player];
            array_push($currentPlayer->matchedCards, $this->currentPair[0]);
            $this->currentPair = [];
            $this->checkGameOver();
        }
    }

    private function checkGameOver()
    {
        $matchedPairs = 0;
        foreach ($this->players as $player) {
            $matchedPairs += count($player->matchedCards);
        }
        if ($matchedPairs == $this->size*$this->size/2) {
            $this->isGameOver = true;
            $this->setWinner();
        }
    }

    private function setWinner()
    {
        $winner = null;
        $maxScore = 0;
        foreach ($this->players as $player) {
            $score = count($player->matchedCards);
            if ($score > $maxScore) {
                $maxScore = $score;
                $winner = $player;
            }
        }
        $this->winner = $winner;
    }

}