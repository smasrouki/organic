<?php

namespace AppBundle\Strategy\EndStrategy;

use AppBundle\Strategy\EndStrategyInterface;

class DepthStrategy implements EndStrategyInterface
{
    protected $depth = 0;

    protected $count = 0;

    /**
     * @return mixed
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @param mixed $depth
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
    }

    public function execute()
    {
        $this->count++;

        if($this->count > $this->depth){
            return true;
        }

        return false;
    }

    public function getCount()
    {
        return $this->count;
    }


}
