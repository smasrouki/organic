<?php

namespace AppBundle\Context;

use AppBundle\Manager\WordManager;
use AppBundle\Entity\WordInterface;
use AppBundle\Strategy\EndStrategyInterface;
use AppBundle\Strategy\InitStrategyInterface;
use AppBundle\Strategy\PulseStrategyInterface;

class BaseContext implements ContextInterface
{
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

    public function __construct(InitStrategyInterface $initStrategy, EndStrategyInterface $endStrategy, PulseStrategyInterface $pulseStrategy)
    {
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
     * @return mixed
     */
    public function getCurrentValue()
    {
        return $this->currentValue;
    }

    /**
     * @param mixed $endStrategy
     */
    public function setEndStrategy($endStrategy)
    {
        $this->endStrategy = $endStrategy;
    }

    public function getWord(WordInterface $word = null)
    {
        if($this->endStrategy->execute()){
            return null;
        }

        if($word){
            return $this->pulseStrategy->execute($word);
        }

        return $this->initStrategy->execute();
    }
}
