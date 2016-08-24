<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Link
 *
 * @ORM\Table(name="link")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LinkRepository")
 */
class Link
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Word
     *
     * @ORM\ManyToOne(targetEntity="Word", inversedBy="links")
     */
    private $word1;

    /**
     * @var Word
     *
     * @ORM\ManyToOne(targetEntity="Word")
     */
    private $word2;

    /**
     * @var int
     *
     * @ORM\Column(name="count", type="integer")
     */
    private $count;


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
     * Set word1
     *
     * @param \AppBundle\Entity\Word $word1
     * @return Link
     */
    public function setWord1(\AppBundle\Entity\Word $word1 = null)
    {
        $this->word1 = $word1;

        return $this;
    }

    /**
     * Get word1
     *
     * @return \AppBundle\Entity\Word 
     */
    public function getWord1()
    {
        return $this->word1;
    }

    /**
     * Set word2
     *
     * @param \AppBundle\Entity\Word $word2
     * @return Link
     */
    public function setWord2(\AppBundle\Entity\Word $word2 = null)
    {
        $this->word2 = $word2;

        return $this;
    }

    /**
     * Get word2
     *
     * @return \AppBundle\Entity\Word 
     */
    public function getWord2()
    {
        return $this->word2;
    }

    /**
     * Set count
     *
     * @param integer $count
     * @return Link
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }
}
