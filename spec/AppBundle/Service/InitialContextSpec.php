<?php

namespace spec\AppBundle\Service;

use AppBundle\Entity\Word;
use AppBundle\Manager\WordManager;
use AppBundle\Service\ContextInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InitialContextSpec extends ObjectBehavior
{
    function let(WordManager $wordManager){
        $this->beConstructedWith($wordManager);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Service\InitialContext');
        $this->shouldImplement('AppBundle\Service\ContextInterface');
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
}
