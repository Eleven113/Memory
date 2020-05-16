<?php

namespace App\Entity;

use App\Repository\NumbplayerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NumbplayerRepository::class)
 */
class Numbplayer
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
    private $HIghscore;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHIghscore(): ?string
    {
        return $this->HIghscore;
    }

    public function setHIghscore(string $HIghscore): self
    {
        $this->HIghscore = $HIghscore;

        return $this;
    }
}
