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
    function let(WordManager $wordManager, InitStrategyInterface $initStrategy, EndStrategyInterface $endStrategy, PulseStrategyInterface $pulseStrategy){
        $this->beConstructedWith($wordManager, 1, $initStrategy, $endStrategy, $pulseStrategy);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Context\BaseContext');
        $this->shouldImplement('AppBundle\Context\ContextInterface');
    }

    function it_should_have_a_context_status()
    {
        $this->getStatus()->shouldReturn(ContextInterface::STATUS_NEW);
    }

    function it_has_an_init_startegy(InitStrategyInterface $strategy)
    {
        $this->setInitStrategy($strategy);
        $this->getInitStrategy()->shouldReturn($strategy);

    }

    function it_has_a_pulse_startegy(PulseStrategyInterface $strategy)
    {
        $this->setPulseStrategy($strategy);
        $this->getPulseStrategy()->shouldReturn($strategy);

    }

    function it_has_an_end_startegy(EndStrategyInterface $strategy)
    {
        $this->setEndStrategy($strategy);
        $this->getEndStrategy()->shouldReturn($strategy);

    }

    function it_should_use_an_init_strategy_new_context(InitStrategyInterface $initStrategy)
    {
        $this->getWord();

        $initStrategy->execute()->shouldHaveBeenCalled();
    }

    function it_has_a_depth()
    {
        $depth = Argument::any();

        $this->setDepth($depth);
        $this->getDepth()->shouldReturn($depth);
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

    function it_should_update_itself_from_a_given_value(WordManager $wordManager, Word $w1, Word $w2)
    {
        $value = Argument::any();

        $this->setDepth(2);

        $wordManager->findByValue($value)->willReturn($w1);

        $this->update($value);
        $this->getWord()->shouldReturn($w1);

        $wordManager->getBestLink($w1)->willReturn($w2);

        $this->getWord($w1)->shouldReturn($w2);
    }
}
