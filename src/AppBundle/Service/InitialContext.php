<?php

namespace AppBundle\Service;

use AppBundle\Manager\WordManager;

class InitialContext implements ContextInterface
{
    protected $wordManager;

    public function __construct(WordManager $wordManager)
    {
        $this->wordManager = $wordManager;
    }

    public function getWord()
    {
        return $this->wordManager->getBest();
    }

    public function getStatus()
    {
        return ContextInterface::STATUS_NEW;
    }
}
