<?php

namespace spec\AppBundle\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LinkSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Entity\Link');
    }

    function it_should_generate_an_index()
    {
        
    }
}
