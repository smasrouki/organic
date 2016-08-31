<?php

namespace spec\Component\Text;

use Component\Text\Package;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WordSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Component\Text\Word');
    }

    function it_has_a_value()
    {
    	$value = Argument::Any();

        $this->setValue($value);
        $this->getValue()->shouldReturn($value);
    }

    function it_has_a_count()
    {
        $count = Argument::any();

        $this->setCount($count);
        $this->getCount()->shouldReturn($count);
    }

    function it_has_a_package(Package $package)
    {
        $this->setPackage($package);
        $this->getPackage()->shouldReturn($package);

    }
}
