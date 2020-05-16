<?php

namespace App\Entity;

use App\Repository\HighscoreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HighscoreRepository::class)
 */
class Highscore
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $player;

    /**
     * @ORM\Column(type="integer")
     */
    private $time;

    /**
     * @ORM\Column(type="integer")
     */
    private $cardnumb;

    /**
     * @ORM\Column(type="integer")
     */
    private $try;

    /**
     * @ORM\Column(type="integer")
     */
    private $playernumb;

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

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getCardnumb(): ?int
    {
        return $this->cardnumb;
    }

    public function setCardnumb(int $cardnumb): self
    {
        $this->cardnumb = $cardnumb;

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

    public function getPlayernumb(): ?int
    {
        return $this->playernumb;
    }

    public function setPlayernumb(int $playernumb): self
    {
        $this->playernumb = $playernumb;

        return $this;
    }
}
