<?php

namespace spec\AppBundle\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use AppBundle\Entity\Word;

class LinkSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Entity\Link');
    }

    function it_should_increment_its_count()
    {
        $this->getCount()->shouldReturn(1);

        $this->increment();
        $this->getCount()->shouldReturn(2);
    }
}
