<?php

namespace spec\AppBundle\Strategy\InitStrategy;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use AppBundle\Manager\WordManager;
use AppBundle\Entity\Word;

class BestWordStrategySpec extends ObjectBehavior
{
    function let(WordManager $wordManager)
    {
        $this->beConstructedWith($wordManager);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Strategy\InitStrategy\BestWordStrategy');
        $this->shouldImplement('AppBundle\Strategy\InitStrategyInterface');
    }

    function it_has_a_word_manager(WordManager $wordManager)
    {
        $this->setWordManager($wordManager);
        $this->getWordManager()->shouldReturn($wordManager);
    }

    function it_should_return_the_best_word_when_executed(WordManager $wordManager, Word $word)
    {
        $wordManager->getBest()->willReturn($word);
        $this->execute()->shouldReturn($word);
    }
}
