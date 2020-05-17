<?php


namespace App\Memory;


use JsonSerializable;

/**
 * Class Card
 * Une carte du jeu
 * @package App\Memory
 */
class Card implements JsonSerializable
{
    private $symbol;
    private $status;

    /**
     * Card constructor.
     * @param string $symbol
     */
    public function __construct($symbol)
    {
        $this->symbol = $symbol;
        $this->status = "hidden";
    }

    /**
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * @param string $symbol
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function __toString()
    {
        return "Card{" .
            "symbol='" . $this->symbol . '\'' .
            ", status='" . $this->status . '\'' .
            '}';
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}