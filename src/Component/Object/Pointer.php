<?php

namespace Component\Object;

class Pointer extends Object{
    /**
     * @var Decorator
     */
    protected $subject;

    /**
     * @return Decorator
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param Decorator $subject
     */
    public function setSubject(Decorator $subject)
    {
        $this->subject = $subject;
    }

    public function process()
    {
        $value = parent::process();

        if($this->subject){
            $value .= ' '.$this->subject->process();
        }

        return $value;
    }
} 