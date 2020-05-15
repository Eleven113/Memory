<?php


namespace App\Memory;


class Player
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
    }

    /**
     * @return void
     */
    public function updateCount() {
        $this->tryCount++;
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


}