<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Word;

class WordManager extends BaseManager
{
    protected $maxCount;

    /**
     * @return mixed
     */
    public function getMaxCount()
    {
        return $this->maxCount;
    }

    /**
     * @param mixed $maxCount
     */
    public function setMaxCount($maxCount)
    {
        $this->maxCount = $maxCount;
    }

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
        $word->setType(round($count/$this->maxCount));

        $this->persist($word);

        return $word;
    }
}