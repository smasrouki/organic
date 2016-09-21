<?php

namespace Component\Object;

class Object {
    protected $value;

    function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function process()
    {
        return $this->value;
    }

    public function toProxy()
    {
        $proxy = new Proxy($this->value);

        return $proxy;
    }

    public function toBridge()
    {
        $bridge = new Bridge($this->value);

        return $bridge;
    }
} 