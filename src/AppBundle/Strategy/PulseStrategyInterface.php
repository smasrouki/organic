<?php

namespace AppBundle\Strategy;

use AppBundle\Entity\WordInterface;

interface PulseStrategyInterface
{
    /**
     * @param WordInterface $word
     *
     * @return WordInterface
     */
    public function execute(WordInterface $word);
}