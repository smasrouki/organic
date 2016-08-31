<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Component\Text\Package as PackageModel;

/**
 * Package
 */
class Package extends PackageModel
{
    /**
     * @var int
     */
    private $id;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->words = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add words
     *
     * @param \AppBundle\Entity\Word $words
     * @return Package
     */
    public function addWord(\AppBundle\Entity\Word $words)
    {
        $this->words[] = $words;
        $words->setPackage($this);

        return $this;
    }

    /**
     * Remove words
     *
     * @param \AppBundle\Entity\Word $words
     */
    public function removeWord(\AppBundle\Entity\Word $words)
    {
        $this->words->removeElement($words);
    }
}
