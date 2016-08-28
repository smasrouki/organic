<?php

namespace AppBundle\Context;

use AppBundle\Entity\WordInterface;

interface ContextInterface
{
    /**
     * @param WordInterface|null $word
     *
     * @return WordInterface
     */
    public function getWord(WordInterface $word = null);
}