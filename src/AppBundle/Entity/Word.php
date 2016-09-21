<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Component\Text\Word as WordModel;

/**
 * Word
 */
class Word extends WordModel
{
    protected static $typeLabels = array(
        self::TYPE_OBJECT => 'Object',
        self::TYPE_DECORATOR => 'Decorator',
        self::TYPE_LINK => 'Link',
    );

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

    public function getTypeLabel()
    {
        if(isset(self::$typeLabels[$this->getType()])){
            return self::$typeLabels[$this->getType()];
        }

        return 'N/A';
    }
}
