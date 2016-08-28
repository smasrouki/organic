<?php

namespace spec\AppBundle\Strategy\PulseStrategy;

use AppBundle\Entity\Word;
use AppBundle\Manager\WordManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BestLinkStrategySpec extends ObjectBehavior
{
    function let(WordManager $wordManager)
    {
        $this->beConstructedWith($wordManager);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Strategy\PulseStrategy\BestLinkStrategy');
        $this->shouldImplement('AppBundle\Strategy\PulseStrategyInterface');
    }

    function it_has_a_word_manager(WordManager $wordManager)
    {
        $this->setWordManager($wordManager);
        $this->getWordManager()->shouldReturn($wordManager);
    }

    function it_should_return_the_best_link_when_executed(WordManager $wordManager, Word $w1, Word $w2)
    {
        $wordManager->getBestLink($w1)->willReturn($w2);
        $this->execute($w1)->shouldReturn($w2);
    }
}
