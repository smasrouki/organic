<?php

namespace Component\Object;


class Link extends Decorator{
    /**
     * @var Object
     */
    protected $preset;

    /**
     * @return Object
     */
    public function getPreset()
    {
        return $this->preset;
    }

    /**
     * @param Object $preset
     */
    public function setPreset(Object $preset)
    {
        $this->preset = $preset;
    }

    public function process()
    {
        $value = parent::process();

        if($this->preset){
            $value = $this->preset->process().' '.$value;
        }

        return $value;
    }

    public function toProxy()
    {
        $proxy = parent::toProxy();

        if($this->preset){
            $proxy->setPreset($this->preset);
        }

        return $proxy;
    }


} 