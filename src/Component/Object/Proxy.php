<?php

namespace Component\Object;

class Proxy extends Link
{
    protected $complements = array();

    /**
     * @return array
     */
    public function getComplements()
    {
        return $this->complements;
    }

    /**
     * @param array $complements
     */
    public function setComplements($complements)
    {
        $this->complements = $complements;
    }

    public function addComplement(Object $complement)
    {
        $this->complements[] = $complement;
    }

    public function process()
    {
        $value = parent::process();

        /**
         * @var $complement Object
         */
        foreach($this->complements as $complement){
            $value .= ' '.$complement->process();
        }

        return $value;
    }

    public function toProxy()
    {
        return $this;
    }


}