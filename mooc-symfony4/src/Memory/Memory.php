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
        $this->currentPair = [];
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

        // Add
        $cards = new \ArrayObject();
        foreach($selectedSymbols as $symbol ){
            $card = new Card($symbol);
            $cards->append($card);
        }

        return $cards;
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
        var_dump($this->cards);
        echo count($this->currentPair);
        if (count($this->currentPair) == 2 || $this->cards[$i]->getStatus() == "visible") {
            echo 'celuici';
            $playResponse = new PlayResponse(null, false, false, $this->isGameOver);
        } else if (count($this->currentPair) == 0) {
            echo 'ce if là';
            $card = $this->cards[$i];
            array_push($this->currentPair, $card);
            $card->setStatus("visible");
            $playResponse = new PlayResponse($card->getSymbol(), false, false, $this->isGameOver);
        } else $playResponse = $this->handleNewPair($i);
        return $playResponse;
    }

    /**
     * @param int $i
     * @return PlayResponse
     */
    private function handleNewPair($i)
    {
        $card = $this->cards[$i];
        array_push($this->currentPair,$card);
        $card->setStatus("visible");
        $matched = ($this->currentPair[0]->symbol == $card->symbol);
        if ($matched) {
            $currentPlayer = $this->players[$this->player];
            array_push($currentPlayer->getMatchedCards(), $this->currentPair[0]);
            $this->currentPair = [];
            $this->checkGameOver();
            $playResponse = new PlayResponse($card->getSymbol(), true, true, $this->isGameOver);
        } else {
            $this->nextPlayer();
            $playResponse = new PlayResponse($card->getSymbol(), true, false, $this->isGameOver);
        }
        $this->players[$this->player]->updateCount();
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