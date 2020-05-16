<?php


namespace App\Memory;


use JsonSerializable;

class PlayResponse implements JsonSerializable
{
//    public $winner;
//  TODO remettre $winner
    /**
     * @var string
     */
    private $symbol;
    /**
     * @var bool
     */
    private $isPairComplete;
    /**
     * @var bool
     */
    private $isMatching;
    /**
     * @var bool
     */
    private $isGameOver;
    /**
     * @var \ArrayObject
     */
    private $players;
    /**
     * @var int
     */
    private $player;
    /**
     * @var string
     */
    private $theme;


    /**
     * PlayResponse constructor.
     * @param string $symbol
     * @param boolean $isPairComplete
     * @param boolean $isMatching
     * @param Memory $memory
     */
    public function __construct($symbol, $isPairComplete, $isMatching, Memory $memory)
    {
        $this->symbol = $symbol;
        $this->isPairComplete = $isPairComplete;
        $this->isMatching = $isMatching;
        $this->isGameOver = $memory->isGameOver();
        $this->players = $memory->getPlayers();
        $this->player = $memory->getPlayer();
        $this->theme = $memory->getTheme();
//        $this->winner = $winner;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}