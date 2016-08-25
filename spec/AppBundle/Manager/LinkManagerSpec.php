<?php

namespace spec\AppBundle\Manager;

use AppBundle\Entity\Link;
use AppBundle\Repository\LinkRepository;
use Doctrine\ORM\EntityManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use AppBundle\Entity\Word;

class LinkManagerSpec extends ObjectBehavior
{
    function let(EntityManager $em, LinkRepository $repository, Link $link){
        $this->beConstructedWith($em);
        $em->getRepository('AppBundle:Link')->willReturn($repository);
        $repository->findByWords(Argument::any(), Argument::any())->willReturn(null);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Manager\LinkManager');
    }

    function it_should_generate_an_index_from_words(Word $w1, Word $w2)
    {
    	$w1->getValue()->willReturn('w1');
        $w2->getValue()->willReturn('w2');


	    $this->getIndexFromWords($w1, $w2)->shouldReturn('w1-w2');
    }

    function it_should_generate_an_index_from_a_links(Link $link, Word $w1, Word $w2)
    {
        $link->getWord1()->willReturn($w1);
        $link->getWord2()->willReturn($w2);

        $w1->getValue()->willReturn('w1');
        $w2->getValue()->willReturn('w2');

        $this->getIndexFromLink($link)->shouldReturn('w1-w2');
    }

    function it_should_generate_links(Word $w1, Word $w2)
    {
        $w1->getValue()->willReturn('w1');
        $w2->getValue()->willReturn('w2');
        $w1->addLink(Argument::any())->willReturn(null);
        $w2->addLink(Argument::any())->willReturn(null);

        $this->generate($w1, $w2);

        $this->getLinks()->shouldHaveCount(1);
        $this->getLinks()->first()->shouldHaveType('AppBundle\Entity\Link');

        $this->getLinks()->first()->getWord1()->getValue()->shouldReturn('w1');
        $this->getLinks()->first()->getWord2()->getValue()->shouldReturn('w2');
    }

    function it_should_count_links(Word $w1, Word $w2, Word $w3)
    {
        $w1->getValue()->willReturn('w1');
        $w2->getValue()->willReturn('w2');
        $w3->getValue()->willReturn('w3');

        $w1->addLink(Argument::any())->willReturn(null);
        $w2->addLink(Argument::any())->willReturn(null);
        $w3->addLink(Argument::any())->willReturn(null);

        $this->generate($w1, $w2);
        $this->generate($w1, $w2);
        $this->generate($w2, $w3);

        $this->getLinks()->shouldHaveCount(2);
        $this->getLinks()->first()->getCount()->shouldReturn(2);
        $this->getLinks()->last()->getCount()->shouldReturn(1);
    }
}
