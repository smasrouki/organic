<?php

namespace AppBundle\Service;


interface ContextInterface
{
    const STATUS_NEW = 0;

    public function getWord();
    public function getStatus();
}