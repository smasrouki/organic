<?php

namespace spec\AppBundle\Context;

use AppBundle\Strategy\EndStrategyInterface;
use AppBundle\Strategy\InitStrategyInterface;
use AppBundle\Strategy\PulseStrategyInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use AppBundle\Manager\WordManager;
use AppBundle\Context\ContextInterface;
use AppBundle\Entity\Word;

class BaseContextSpec extends ObjectBehavior
{
    function let(InitStrategyInterface $initStrategy, EndStrategyInterface $endStrategy, PulseStrategyInterface $pulseStrategy){
        $this->beConstructedWith($initStrategy, $endStrategy, $pulseStrategy);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Context\BaseContext');
        $this->shouldImplement('AppBundle\Context\ContextInterface');
    }

    function it_has_an_init_strategy(InitStrategyInterface $strategy)
    {
        $this->setInitStrategy($strategy);
        $this->getInitStrategy()->shouldReturn($strategy);

    }

    function it_has_a_pulse_strategy(PulseStrategyInterface $strategy)
    {
        $this->setPulseStrategy($strategy);
        $this->getPulseStrategy()->shouldReturn($strategy);

    }

    function it_has_an_end_strategy(EndStrategyInterface $strategy)
    {
        $this->setEndStrategy($strategy);
        $this->getEndStrategy()->shouldReturn($strategy);

    }

    function it_should_use_an_init_strategy_new_context(InitStrategyInterface $initStrategy)
    {
        $this->getWord();

        $initStrategy->execute()->shouldHaveBeenCalled();
    }

    function it_should_use_an_end_strategy(EndStrategyInterface $endStrategy)
    {
        $endStrategy->execute()->willReturn(true);

        $this->getWord()->shouldReturn(null);

        $endStrategy->execute()->shouldHaveBeenCalled();
    }

    function it_should_use_a_pulse_strategy_to_context(PulseStrategyInterface $pulseStrategy, Word $w1)
    {
        $this->getWord($w1);

        $pulseStrategy->execute($w1)->shouldHaveBeenCalled();
    }
}
