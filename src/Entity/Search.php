<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class Search
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $keyword;

    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    public function setKeyWord(string $keyword): self
    {
        $this->keyword = $keyword;

        return $this;
    }
}
