<?php

namespace AppBundle\Strategy;

use AppBundle\Entity\WordInterface;

interface InitStrategyInterface
{
    /**
     * @return WordInterface
     */
    public function execute();
}