<?php

namespace spec\AppBundle\Context;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use AppBundle\Manager\WordManager;
use AppBundle\Context\ContextInterface;
use AppBundle\Entity\WordInterface;
use AppBundle\Entity\Word;

class BaseContextSpec extends ObjectBehavior
{
    function let(WordManager $wordManager){
        $this->beConstructedWith($wordManager);
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

    function it_should_use_best_word_stategy_when_new_context(WordManager $wordManager, Word $w1)
    {
        $wordManager->getBest()->willReturn($w1);

        $this->getWord()->shouldReturn($w1);
    }

    function it_has_a_depth()
    {
        $depth = Argument::any();

        $this->setDepth($depth);
        $this->getDepth()->shouldReturn($depth);
    }

    function it_should_use_depth_strategy_to_end_context(WordManager $wordManager, Word $w1)
    {
        $wordManager->getBest()->willReturn($w1);

        $this->setDepth(2);

        $this->getStatus()->shouldReturn(ContextInterface::STATUS_NEW);

        $this->getWord();
        $this->getWord();

        $this->getStatus()->shouldReturn(ContextInterface::STATUS_END);

        $this->getWord()->shouldReturn(null);
    }

    function it_should_use_best_link_strategy_when_new_context(WordManager $wordManager, Word $w1, Word $w2)
    {
        $wordManager->getBestLink($w1)->willReturn($w2);

        $this->getWord($w1)->shouldReturn($w2);
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
