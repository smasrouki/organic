<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Word;
use Component\Text\Text;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;

class WordManager
{
    protected $em;

    protected $words;

    /**
     * WordManager constructor.
     * @param $words
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;

        $this->words = new ArrayCollection();;
    }


    public function getWords()
    {
        return $this->words;
    }

    public function generateFromText(Text $text, $persist = true)
    {
        foreach($text->getOccurrences() as $value => $count)
        {
            $word = $this->findByValue($value);

            if($word) {
                $word->addCount($count);
            } else {
                $word = new Word();

                $word->setValue($value);
                $word->setCount($count);
            }

            $this->words[] = $word;
        }

        if($persist){
            foreach ($this->words as $word){
                $this->em->persist($word);
            }

            $this->em->flush();
        }
    }

    public function findByValue($value)
    {
        return $this->getRepository()->findOneBy(array('value' => $value));
    }

    public function getRepository()
    {
        return $this->em->getRepository('AppBundle:Word');
    }
} 