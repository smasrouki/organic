<?php

namespace Component\Text;

use Doctrine\Common\Collections\Collection;

class Package
{
    /**
     * @var Collection
     */
    protected $words;

    /**
     * @return Collection
     */
    public function getWords()
    {
        return $this->words;
    }

    /**
     * @param Collection $words
     */
    public function setWords($words)
    {
        $this->words = $words;
    }
}
