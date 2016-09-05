<?php

namespace Component\Text;

use Doctrine\Common\Collections\Collection;

class WordPackager
{
    /**
     * @var Collection
     */
    protected $words;

    protected $packages;

    protected $count;

    protected $wordCount;

    /**
     * @param Collection $words
     */
    function __construct(Collection $words)
    {
        $this->words = $words;
        $this->packages = array();
        $this->count = 1;
        $this->wordCount = 0;

        $this->init();
    }


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

        $this->init();
    }

    public function getPackages()
    {
        return $this->packages;
    }

    protected function init()
    {
        foreach($this->words as $word){
            if($this->wordCount && $word->getCount() > $this->wordCount){
                $this->count++;
                $this->packages[$this->count] = array();
            }

            $this->packages[$this->count][] = $word;
            $this->wordCount = $word->getCount();
        }
    }
}
