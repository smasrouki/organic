<?php

namespace Component\Object;


class Proxy extends Link {
    protected $complements = array();

    /**
     * @return mixed
     */
    public function getComplements()
    {
        return $this->complements;
    }

    public function addComplement(Object $complement)
    {
        $this->complements[] = $complement;
    }

    public function process()
    {
        $value = parent::process();

        foreach($this->complements as $complement){
            $value.= ' '.$complement->process();
        }

        return $value;
    }

    public function toProxy()
    {
        return $this;
    }
} 