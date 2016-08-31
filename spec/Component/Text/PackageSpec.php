<?php

namespace spec\Component\Text;

use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PackageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Component\Text\Package');
    }

    function it_has_words(Collection $words)
    {
    	$this->setWords($words);
	    $this->getWords()->shouldReturn($words);
    }
}
