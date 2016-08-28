<?php

namespace AppBundle\Strategy\PulseStrategy;

use AppBundle\Entity\WordInterface;
use AppBundle\Manager\WordManager;
use AppBundle\Strategy\PulseStrategyInterface;

class BestLinkStrategy implements PulseStrategyInterface
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
     * @param WordInterface $word
     *
     * @return WordInterface
     */
    public function execute(WordInterface $word)
    {
        return $this->wordManager->getBestLink($word);
    }
}
