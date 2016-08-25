<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Link;
use AppBundle\Entity\Word;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;

class LinkManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var ArrayCollection
     */
    protected $links;

    /**
     * LinkManager constructor.
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->links = new ArrayCollection();
    }


    public function getIndexFromWords(Word $w1, Word $w2)
    {
        return $w1->getValue().'-'.$w2->getValue();
    }

    public function getIndexFromLink(Link $link)
    {
        return $this->getIndexFromWords($link->getWord1(), $link->getWord2());
    }

    public function generate(Word $w1, Word $w2)
    {
        $index = $this->getIndexFromWords($w1, $w2);

        $link = $this->getRepository()->findByWords($w1, $w2);

        if($link){
            $link->increment();
            $this->links[$this->getIndexFromLink($link)] = $link;
        } elseif(isset($this->links[$index])){
            $link = $this->links[$index];
            $link->increment();
        } else {
            $link = new Link();

            $link->setWord1($w1);
            $link->setWord2($w2);

            $this->links[$this->getIndexFromLink($link)] = $link;
        }
    }

    public function getLinks()
    {
        return $this->links;
    }

    protected function getRepository()
    {
        return $this->em->getRepository('AppBundle:Link');
    }
}
