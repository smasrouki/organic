<?php

namespace Component\Text;

class Word
{
    const TYPE_OBJECT = 0;
    const TYPE_DECORATOR = 1;
    const TYPE_LINK = 2;
    const TYPE_POINTER = 3;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var integer
     */
    protected $count;

    /**
     * @var Package
     */
    protected $package;

    /**
     * @var integer
     */
    protected $type = 0;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param integer $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * @return Package
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * @param Package $package
     */
    public function setPackage(Package $package)
    {
        $this->package = $package;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}
