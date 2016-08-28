<?php

namespace AppBundle\Strategy\InitStrategy;

use AppBundle\Entity\WordInterface;
use AppBundle\Strategy\InitStrategyInterface;
use AppBundle\Manager\WordManager;

class BestWordStrategy implements InitStrategyInterface
{
    /**
     * @var WordManager
     */
    protected $wordManager;

    /**
     * @param WordManager $wordManager
     */
    function __construct(WordManager $wordManager)
    {
        $this->wordManager = $wordManager;
    }

    /**
     * @return WordManager
     */
    public function getWordManager()
    {
        return $this->wordManager;
    }

    /**
     * @param WordManager $wordManager
     */
    public function setWordManager(WordManager $wordManager)
    {
        $this->wordManager = $wordManager;
    }

    /**
     * @return WordInterface
     */
    public function execute()
    {
        return $this->wordManager->getBest();
    }
}
