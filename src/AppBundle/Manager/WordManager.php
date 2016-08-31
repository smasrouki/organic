<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Word;

class WordManager extends BaseManager
{
    /**
     * @inheritdoc
     */
    protected function getEntityName()
    {
        return 'AppBundle:Word';
    }

    /**
     * Create a Word entity
     * @param string $value
     * @param integer$count
     *
     * @return Word
     */
    public function create($value, $count)
    {
        $word = new Word();

        $word->setValue($value);
        $word->setCount($count);

        $this->persist($word);

        return $word;
    }
}