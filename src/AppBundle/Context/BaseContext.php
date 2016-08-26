<?php

namespace AppBundle\Context;

use AppBundle\Manager\WordManager;
use AppBundle\Entity\WordInterface;
use AppBundle\Strategy\EndStrategyInterface;
use AppBundle\Strategy\InitStrategyInterface;
use AppBundle\Strategy\PulseStrategyInterface;

class BaseContext implements ContextInterface
{
    protected $wordManager;

    protected $depth;

    protected $status;

    protected $lastWord;

    protected $count = 0;

    /**
     * @var InitStrategyInterface
     */
    protected $initStrategy;

    /**
     * @var PulseStrategyInterface
     */
    protected $pulseStrategy;

    /**
     * @var EndStrategyInterface
     */
    protected $endStrategy;

    public function __construct(WordManager $wordManager, $depth = 1, InitStrategyInterface $initStrategy, EndStrategyInterface $endStrategy, PulseStrategyInterface $pulseStrategy)
    {
        $this->wordManager = $wordManager;
        $this->status = ContextInterface::STATUS_NEW;
        $this->depth = $depth;

        $this->initStrategy = $initStrategy;
        $this->endStrategy = $endStrategy;
        $this->pulseStrategy = $pulseStrategy;
    }

    /**
     * @return mixed
     */
    public function getInitStrategy()
    {
        return $this->initStrategy;
    }

    /**
     * @param mixed $initStrategy
     */
    public function setInitStrategy($initStrategy)
    {
        $this->initStrategy = $initStrategy;
    }

    /**
     * @return mixed
     */
    public function getPulseStrategy()
    {
        return $this->pulseStrategy;
    }

    /**
     * @param mixed $pulseStrategy
     */
    public function setPulseStrategy($pulseStrategy)
    {
        $this->pulseStrategy = $pulseStrategy;
    }

    /**
     * @return mixed
     */
    public function getEndStrategy()
    {
        return $this->endStrategy;
    }

    /**
     * @param mixed $endStrategy
     */
    public function setEndStrategy($endStrategy)
    {
        $this->endStrategy = $endStrategy;
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
        /*
        if($this->status == ContextInterface::STATUS_END){
            return null;
        }

        $this->updateStatus();
        */

        if($this->endStrategy->execute()){
            return null;
        }

        if($word){
            //$this->lastWord = $this->wordManager->getBestLink($word);
            $this->lastWord = $this->pulseStrategy->execute($word);
        }elseif($this->lastWord === null) {
            //$this->lastWord = $this->wordManager->getBest();
            $this->lastWord = $this->initStrategy->execute();
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
