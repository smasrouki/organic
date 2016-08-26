<?php

namespace AppBundle\Context;

use AppBundle\Manager\WordManager;
use AppBundle\Entity\WordInterface;
use AppBundle\Entity\Word;

class BaseContext implements ContextInterface
{
    protected $wordManager;

    protected $depth;

    protected $status;

    protected $lastWord;

    protected $count = 0;

    public function __construct(WordManager $wordManager, $depth = 1)
    {
        $this->wordManager = $wordManager;
        $this->status = ContextInterface::STATUS_NEW;
        $this->depth = $depth;
    }

    /**
     * @return mixed
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @param mixed $depth
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
    }

    public function getWord(WordInterface $word = null)
    {
        if($this->status == ContextInterface::STATUS_END){
            return null;
        }

        $this->updateStatus();

        if($word){
            $this->lastWord = $this->wordManager->getBestLink($word);
        }elseif($this->lastWord === null) {
            $this->lastWord = $this->wordManager->getBest();
        }

        return $this->lastWord;
    }

    public function getStatus()
    {
        return $this->status;
    }

    protected function updateStatus()
    {
        $this->count++;

        if($this->depth == $this->count){
            $this->status = ContextInterface::STATUS_END;
            $this->count = 0;
        }
    }

    public function update($value)
    {
        $this->lastWord = $this->wordManager->findByValue($value);
        $this->status = ContextInterface::STATUS_CONTINUE;
    }
}
