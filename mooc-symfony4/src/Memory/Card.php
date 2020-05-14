<?php


namespace App\Memory;


class Card
{
    private $symbol;
    private $status;

    /**
     * Card constructor.
     * @param $symbol
     */
    public function __construct($symbol)
    {
        $this->symbol = $symbol;
        $this->status = "hidden";
    }

    /**
     * @return mixed
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * @param mixed $symbol
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


}