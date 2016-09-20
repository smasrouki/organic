<?php

namespace Component\Object;


class Decorator extends Object{
    /**
     * @var Object
     */
    protected $subject;

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject(Object $subject)
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

    public function toProxy()
    {
        $proxy = parent::toProxy();

        $proxy->setSubject($this->subject);

        return $proxy;
    }


} 