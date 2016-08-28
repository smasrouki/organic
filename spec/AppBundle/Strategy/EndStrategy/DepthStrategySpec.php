<?php

namespace spec\AppBundle\Strategy\EndStrategy;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DepthStrategySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Strategy\EndStrategy\DepthStrategy');
        $this->shouldImplement('AppBundle\Strategy\EndStrategyInterface');
    }

    function it_has_a_depth()
    {
        $depth = Argument::any();

        $this->setDepth($depth);
        $this->getDepth()->shouldReturn($depth);
    }

    function it_has_a_count()
    {
        $this->getCount()->shouldReturn(0);
    }

    function it_should_use_count_to_decide_end()
    {
        $this->setDepth(2);

        $this->execute()->shouldReturn(false);
        $this->execute()->shouldReturn(false);
        $this->execute()->shouldReturn(true);
    }
}
