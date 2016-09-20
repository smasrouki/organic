<?php

namespace spec\Component\Text;

use Component\Text\Word;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WordPackagerSpec extends ObjectBehavior
{
    function let(Collection $words, \Iterator $iterator)
    {
        $words->getIterator()->willReturn($iterator);

        $this->beConstructedWith($words);

        $this->getWords()->shouldReturn($words);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Component\Text\WordPackager');
    }

    function it_has_words(Collection $words, \Iterator $iterator)
    {
        $words->getIterator()->willReturn($iterator);

        $this->setWords($words);
        $this->getWords()->shouldReturn($words);
    }

    function it_should_process_packages_from_words(Word $w1, Word $w2, Word $w3, Word $w4)
    {
        $this->getPackages()->shouldReturn(array());

        $w1->getCount()->willReturn(5);
        $w1->setType(Argument::any())->willReturn(null);
        $w1->getType()->willReturn(0);
        $w2->getCount()->willReturn(103);
        $w2->setType(Argument::any())->willReturn(null);
        $w2->getType()->willReturn(0);
        $w3->getCount()->willReturn(1);
        $w3->setType(Argument::any())->willReturn(null);
        $w3->getType()->willReturn(0);
        $w4->getCount()->willReturn(17);
        $w4->setType(Argument::any())->willReturn(null);
        $w4->getType()->willReturn(0);


        $words = new ArrayCollection();
        $words->add($w1->getWrappedObject());
        $words->add($w2->getWrappedObject());
        $words->add($w3->getWrappedObject());
        $words->add($w4->getWrappedObject());

        $this->setWords($words);

        $this->getPackages()->shouldReturn(array('1' => array($w1), '2' => array($w2, $w3), '3' => array($w4)));
    }

    function it_should_transform_words(Word $w1, Word $w2, Word $w3, Word $w4)
    {
        $this->getPackages()->shouldReturn(array());

        // Decorator
        $w1->getCount()->willReturn(5);
        $w1->setType(Argument::any())->willReturn(null);
        $w1->getType()->willReturn(1);

        // Link
        $w2->getCount()->willReturn(103);
        $w2->setType(Argument::any())->willReturn(null);
        $w2->getType()->willReturn(0);

        // Object
        $w3->getCount()->willReturn(1);
        $w3->setType(Argument::any())->willReturn(null);
        $w3->getType()->willReturn(0);

        // Preset
        $w4->getCount()->willReturn(17);
        $w4->setType(Argument::any())->willReturn(null);
        $w4->getType()->willReturn(0);


        $words = new ArrayCollection();
        $words->add($w1->getWrappedObject());
        $words->add($w2->getWrappedObject());
        $words->add($w3->getWrappedObject());
        $words->add($w4->getWrappedObject());

        $this->setWords($words);

        $w1->setType(Word::TYPE_LINK)->shouldNotHaveBeenCalled();
        $w2->setType(Word::TYPE_LINK)->shouldHaveBeenCalled();
        $w3->setType(Word::TYPE_LINK)->shouldNotHaveBeenCalled();
        $w4->setType(Word::TYPE_POINTER)->shouldHaveBeenCalled();
    }
}
