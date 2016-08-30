<?php

namespace AppBundle\Manager;


use AppBundle\Entity\Word;
use Doctrine\ORM\EntityManager;

class WordManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * WordManager constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getRepository()
    {
        return $this->em->getRepository('AppBundle:Word');
    }

    public function removeAll()
    {
        return $this->getRepository()->removeAll();
    }

    public function persist(Word $word)
    {
        $this->em->persist($word);
    }

    public function flush()
    {
        $this->em->flush();
    }

    public function create($value, $count)
    {
        $word = new Word();

        $word->setValue($value);
        $word->setCount($count);

        $this->persist($word);

        return $word;
    }
}