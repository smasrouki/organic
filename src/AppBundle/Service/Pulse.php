<?php

namespace AppBundle\Service;

class Pulse implements PulseInterface
{
    /**
     * @var ContextInterface
     */
    protected $context;

    /**
     * Pulse constructor.
     *
     * @param ContextInterface $context
     */
    public function __construct(ContextInterface $context)
    {
        $this->context = $context;
    }

    /**
     * @return mixed
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param mixed $context
     */
    public function setContext(ContextInterface $context)
    {
        $this->context = $context;
    }

    public function getText()
    {
        $word = $this->context->getWord();

        if($word){
            return $word->getValue();
        }

        return '';
    }
}
