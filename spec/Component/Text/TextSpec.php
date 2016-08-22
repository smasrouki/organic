<?php

namespace spec\Component\Text;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TextSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Initial content');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Component\Text\Text');
    }

    function it_has_a_content()
    {
        $this->getContent()->shouldReturn('Initial content');

        $content = 'Random content';

        $this->setContent($content);
        $this->getContent()->shouldReturn($content);
    }

    function it_has_elements()
    {
        $elements = array('a', 'b', 'c');

        $this->setElements($elements);
        $this->getElements()->shouldReturn($elements);
    }

    function it_should_process_elements_from_initial_content()
    {
        $result = array(
            'I' => 1,
            'n' => 3,
            'i' => 2,
            't' => 3,
            'a' => 1,
            'l' => 1,
            ' ' => 1,
            'c' => 1,
            'o' => 1,
            'e' => 1
        );

        $this->getElements()->shouldReturn($result);
    }

    function it_should_order_elements()
    {
        $result = array(
            'n', 't', 'i', 'o' , 'e', 'c', 'a', 'I', 'l', ' ',
        );

        $this->getOrderedElements()->shouldReturn($result);
    }

    function it_has_a_separator()
    {
        $separator = 'any';

        $this->setSeparator($separator);
        $this->getSeparator()->shouldReturn($separator);
    }

    function it_should_process_parts_from_content()
    {
        $content = 'w1#w2#w3';
        $this->beConstructedWith($content, '#');

        $this->getParts()->shouldReturn(array('w1', 'w2', 'w3'));
    }

    function it_should_process_parts_occurrences_from_content()
    {
        $content = '#w1#w2#w3#w1#w3';
        $this->beConstructedWith($content, '#');

        $result = array(
            'w1' => 2,
            'w2' => 1,
            'w3' => 2,
        );

        $this->getOccurrences()->shouldReturn($result);
    }

    function it_should_process_content_when_new_content_is_set()
    {
        $newContent = 'new';

        $this->setContent($newContent);

        $this->getElements()->shouldReturn(array('n' => 1, 'e' => 1, 'w' => 1));
    }

    function it_should_accept_a_separator_as_parameter()
    {
        $content = 'w1#w2';
        $separator = "#";

        $this->beConstructedWith($content, $separator);

        $this->getParts()->shouldReturn(array('w1', 'w2'));

        $this->setSeparator('w');
        $this->getParts()->shouldReturn(array('1#', '2'));
    }

    function it_should_clean_content()
    {
        $content = "w1\r\nw2. w3, w4'w5 W6\n";
        $separator = ' ';

        $this->beConstructedWith($content, $separator);

        $this->getParts()->shouldReturn(array('w1', 'w2', 'w3', 'w4', 'w5', 'w6'));
    }
}
