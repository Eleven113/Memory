<?php


namespace App\Memory;


class Memory
{
    private $size;
    private $players;
    private $symbols = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    private $cards = [];
    private $player;
    private $currentPair;
    private $isGameOver;
    private $winner;
    private $theme;

    /**
     * Memory constructor.
     * @param int $size
     * @param string[] $names
     * @param string $theme
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

    /**
     * @param int $size
     * @return array
     */
    private function generateCards($size)
    {
        $candidates = str_split($this->symbols, 1);
        shuffle($candidates);
        $selectedSymbols = [];
        for ($i = 0; $i < $size - 1; $i++) {
            $symbol = $candidates[0];
            $candidates = array_slice($candidates,1);
            array_push($selectedSymbols, $symbol, $symbol);
        }
        shuffle($selectedSymbols);
        return $selectedSymbols;
    }

    /**
     * @return void
     */
    private function nextPlayer() {
        if ($this->player == count($this->players - 1)) {
            $this->player = 0;
        } else $this->player++;
    }

    /**
     * @param int $i
     * @return PlayResponse
     */
    public function play($i) {
        if (count($this->currentPair) == 2 || $this->cards[$i]->getStatus() == "visible") {
            $playResponse = new PlayResponse(null, false, false, false);
        } else if (count($this->currentPair) == 0) {
            array_push($this->currentPair,$this->cards[$i]);
            $this->currentPair[0]->setStatus("visible");
            $playResponse = new PlayResponse();
        } else $playResponse = $this->handleNewPair($i);
        return $playResponse;
    }

    /**
     * @param int $i
     * @return PlayResponse
     */
    private function handleNewPair($i)
    {
        array_push($this->currentPair,$this->cards[$i]);
        $this->currentPair[1]->setStatus("visible");
        $matched = ($this->currentPair[0]->symbol == $this->currentPair[1]->symbol);
        if ($matched) {
            $currentPlayer = $this->players[$this->player];
            array_push($currentPlayer->getMatchedCards(), $this->currentPair[0]);
            $this->currentPair = [];
            $this->checkGameOver();
            $playResponse = new PlayResponse();
        } else {
            $this->nextPlayer();
            $playResponse = new PlayResponse();
        }
        return $playResponse;
    }

    /**
     * @return void
     */
    private function checkGameOver()
    {
        $matchedPairs = 0;
        foreach ($this->players as $player) {
            $matchedPairs += count($player->getMatchedCards());
        }
        if ($matchedPairs == $this->size/2) {
            $this->isGameOver = true;
            $this->setWinner();
        }
    }

    /**
     * @return void
     */
    private function setWinner()
    {
        $winner = null;
        $maxScore = 0;
        foreach ($this->players as $player) {
            $score = count($player->getMatchedCards());
            if ($score > $maxScore) {
                $maxScore = $score;
                $winner = $player;
            }
        }
        $this->winner = $winner;
    }

    /**
     * @return array
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @return int
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @return array
     */
    public function getCards()
    {
        return $this->cards;
    }

}