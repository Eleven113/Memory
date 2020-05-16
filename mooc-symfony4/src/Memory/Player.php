<?php


namespace App\Memory;


use JsonSerializable;

class Player implements JsonSerializable
{
    private $matchedCards;
    private $name;
    private $tryCount;

    /**
     * Player constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->matchedCards = [];
        $this->tryCount = 0;
    }

    /**
     * @return void
     */
    public function updateCount() {
        $this->tryCount++;
    }

    public function addMatchedCard(Card $card) {
        array_push($this->matchedCards, $card);
    }

    /**
     * @return array
     */
    public function getMatchedCards()
    {
        return $this->matchedCards;
    }

    /**
     * @param array $matchedCards
     */
    public function setMatchedCards($matchedCards)
    {
        $this->matchedCards = $matchedCards;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getTryCount()
    {
        return $this->tryCount;
    }

    /**
     * @param int $tryCount
     */
    public function setTryCount($tryCount)
    {
        $this->tryCount = $tryCount;
    }

    public function __toString()
    {
        return "Player{" .
            "matchedCards=" . $this->matchedCards .
            ", name='" . $this->name . '\'' .
            ", tryCount='" . $this->tryCount . '\'' .
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