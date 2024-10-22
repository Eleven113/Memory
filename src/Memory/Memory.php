<?php


namespace App\Memory;

/**
 * Une partie de Memory
 * Class Memory
 * @package App\Memory
 */
class Memory
{
    private $difficulty;
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
     * @param string $difficulty
     * @param string[] $names
     * @param string $theme
     */
    public function __construct($difficulty, $names, $theme)
    {
        $this->players = [];
        $this->players = array_map(function ($name) {
            return new Player($name);
        }, $names);
        $this->player = 0;
        $this->difficulty = $difficulty;
        switch ($difficulty) {
            case "easy":
                $size = 6;
                break;
            case "medium":
                $size = 12;
                break;
            case "hard":
                $size = 18;
                break;
            default:
                $size = 12;
        }
        $this->size = $size;
        $this->cards = $this->generateCards($size);
        $this->isGameOver = false;
        $this->theme = $theme;
        $this->currentPair = [];
        $this->winner = null;
    }

    /**
     * Génère les cartes
     * @param int $size
     * @return object
     */
    private function generateCards($size)
    {
        $candidates = str_split($this->symbols, 1);
        shuffle($candidates);
        $selectedSymbols = [];
        for ($i = 0; $i < $size / 2 ; $i++) {
            $symbol = $candidates[0];
            $candidates = array_slice($candidates,1);
            array_push($selectedSymbols, $symbol, $symbol);
        }
        shuffle($selectedSymbols);

        $cards = new \ArrayObject();
        foreach($selectedSymbols as $symbol ){
            $card = new Card($symbol);
            $cards->append($card);
        }

        return $cards;
    }

    /**
     * Change de joueur
     * @return void
     */
    private function nextPlayer() {
        if ($this->player == count($this->players) - 1) {
            $this->player = 0;
        } else $this->player++;
        $this->hideCurrentPair();
    }

    /**
     * Joue la $i-ème carte
     * @param int $i
     * @return PlayResponse
     */
    public function play($i) {
        if (count($this->currentPair) == 2 || $this->cards[$i]->getStatus() == "visible") {
            $playResponse = new PlayResponse(null, false, false, $this);
        } else if (count($this->currentPair) == 0) {
            $card = $this->cards[$i];
            array_push($this->currentPair, $card);
            $card->setStatus("visible");
            $playResponse = new PlayResponse($card->getSymbol(), false, false, $this);
        } else $playResponse = $this->handleNewPair($i);
        return $playResponse;
    }

    /**
     * Détermine si la paire constituée correspond ou non, puis passe au tour suivant
     * @param int $i
     * @return PlayResponse
     */
    private function handleNewPair($i)
    {
        $card = $this->cards[$i];
        $currentPlayer = $this->players[$this->player];
        array_push($this->currentPair,$card);
        $card->setStatus("visible");
        $matched = ($this->currentPair[0]->getSymbol() == $card->getSymbol());
        if ($matched) {
            $currentPlayer->addMatchedCard($this->currentPair[0]);
            $this->currentPair = [];
            $this->checkGameOver();
            $playResponse = new PlayResponse($card->getSymbol(), true, true, $this);
        } else {
            $this->nextPlayer();
            $playResponse = new PlayResponse($card->getSymbol(), true, false, $this);
        }
        $currentPlayer->updateCount();
        return $playResponse;
    }

    /**
     * Masque la paire de cartes si elles ne correspondent pas
     */
    public function hideCurrentPair() {
        $this->currentPair[0]->setStatus("hidden");
        $this->currentPair[1]->setStatus("hidden");
        $this->currentPair = [];
    }

    /**
     * Vérifie si le jeu est terminé
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
     * Détermine le gagnant de la partie
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

    /**
     * @return bool
     */
    public function isGameOver()
    {
        return $this->isGameOver;
    }

    /**
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return Player
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * @return mixed
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

}