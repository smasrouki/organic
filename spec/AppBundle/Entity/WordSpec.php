<?php

namespace spec\AppBundle\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WordSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Entity\Word');
    }

    function it_can_increment_its_count_by_a_value()
    {
    	$value = 13;

	$this->setCount(1);
	$this->addCount($value);

	$this->getCount()->shouldReturn(14);
    }
}
