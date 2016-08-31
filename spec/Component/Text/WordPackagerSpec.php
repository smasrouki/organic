<?php

namespace spec\Component\Text;

use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WordPackagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Component\Text\WordPackager');
    }

    function it_has_words(Collection $words)
    {
        $this->setWords($words);
        $this->getWords()->shouldReturn($words);
    }

    function it_should_process_packages_from_words()
    {

    }
}
