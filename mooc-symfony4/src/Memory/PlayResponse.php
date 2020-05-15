<?php


namespace App\Memory;


class PlayResponse
{
    public $symbol;
    public $isPairComplete;
    public $isMatching;
    public $isGameOver;

    /**
     * PlayResponse constructor.
     * @param $symbol
     * @param $isPairComplete
     * @param $isMatching
     * @param $isGameOver
     */
    public function __construct($symbol, $isPairComplete, $isMatching, $isGameOver)
    {
        $this->symbol = $symbol;
        $this->isPairComplete = $isPairComplete;
        $this->isMatching = $isMatching;
        $this->isGameOver = $isGameOver;
    }


}