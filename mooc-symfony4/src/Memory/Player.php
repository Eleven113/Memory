<?php


namespace App\Memory;


class Player
{
    private $matchedCards;
    private $name;

    /**
     * Player constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
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

    public function __toString()
    {
        return "Player{" .
            "matchedCards=" . $this->matchedCards .
            ", name='" . $this->name . '\'' .
            '}';
    }


}