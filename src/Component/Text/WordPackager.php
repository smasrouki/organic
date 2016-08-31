<?php

namespace Component\Text;

use Doctrine\Common\Collections\Collection;

class WordPackager
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
    public function setWords(Collection $words)
    {
        $this->words = $words;
    }
}
