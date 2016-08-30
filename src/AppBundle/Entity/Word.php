<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Component\Text\Word as WordModel;

/**
 * Word
 */
class Word extends WordModel
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
}
