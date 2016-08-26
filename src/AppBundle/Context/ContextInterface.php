<?php

namespace AppBundle\Context;

use AppBundle\Entity\WordInterface;

interface ContextInterface
{
    const STATUS_NEW = 0;
    const STATUS_END = 1;
    const STATUS_CONTINUE = 2;

    /**
     * @param WordInterface|null $word
     *
     * @return WordInterface
     */
    public function getWord(WordInterface $word = null);

    public function getStatus();

    public function update($value);
}