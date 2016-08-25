<?php

namespace spec\AppBundle\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use AppBundle\Service\ContextInterface;

class PulseSpec extends ObjectBehavior
{
    function let(ContextInterface $context)
    {
        $this->beConstructedWith($context);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Service\Pulse');
        $this->shouldImplement('AppBundle\Service\PulseInterface');
    }

    function it_has_a_context(ContextInterface $context)
    {
        $this->setContext($context);
        $this->getContext()->shouldReturn($context);
    }

    function it_should_initialize_the_context_when_none_is_given(ContextInterface $context)
    {
        $this->getContext()->shouldReturn($context);
    }

    function it_should_use_context_to_get_text(ContextInterface $context)
    {
        $this->getText();
        $context->getWord()->shouldHaveBeenCalled();
    }
}
