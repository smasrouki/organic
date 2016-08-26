<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Word;
use Component\Text\Text;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Link;

class WordManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var LinkManager
     */
    protected $linkManager;

    /**
     * @var ArrayCollection
     */
    protected $words;

    /**
     * WordManager constructor.
     * @param $words
     */
    public function __construct(EntityManager $em, LinkManager $linkManager)
    {
        $this->em = $em;
        $this->linkManager = $linkManager;

        $this->words = new ArrayCollection();
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

            $this->words[$word->getValue()] = $word;
        }

        // Links
        $previousWord = null;

        foreach($text->getParts() as $value){
            $word = $this->words[$value];

            if($previousWord){
                $this->linkManager->generate($previousWord, $word);
            }

            $previousWord = $word;
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

    public function getLinks()
    {
        return $this->linkManager->getLinks();
    }

    public function getBest()
    {
        return $this->getRepository()->getBest();
    }

    public function getBestLink(Word $word)
    {
        /**
         * @var Link
         */
        $link = $word->getLinks()->first();

        if($link){
            return $link->getWord2();
        }

        return null;
    }
} 