<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Highscore
 *
 * @ORM\Table(name="highscore")
 * @ORM\Entity
 */
class Highscore
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="player", type="string", length=255, nullable=false)
     */
    private $player;

    /**
     * @var string
     *
     * @ORM\Column(name="time", type="string", length=255, nullable=false)
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="difficulty", type="string", length=255, nullable=false)
     */
    private $difficulty;

    /**
     * @var int
     *
     * @ORM\Column(name="try", type="integer", nullable=false)
     */
    private $try;

    /**
     * @var int
     *
     * @ORM\Column(name="numplayers", type="integer", nullable=false)
     */
    private $numplayers;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?string
    {
        return $this->player;
    }

    public function setPlayer(string $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(string $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getTry(): ?int
    {
        return $this->try;
    }

    public function setTry(int $try): self
    {
        $this->try = $try;

        return $this;
    }

    public function getNumplayers(): ?int
    {
        return $this->numplayers;
    }

    public function setNumplayers(int $numplayers): self
    {
        $this->numplayers = $numplayers;

        return $this;
    }


}
