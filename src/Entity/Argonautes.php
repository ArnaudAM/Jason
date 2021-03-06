<?php

namespace App\Entity;

use App\Repository\ArgonautesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArgonautesRepository::class)
 */
class Argonautes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $softskill;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSoftskill(): ?string
    {
        return $this->softskill;
    }

    public function setSoftskill(string $softskill): self
    {
        $this->softskill = $softskill;

        return $this;
    }
}
