<?php

namespace spec\AppBundle\Manager;

use Component\Text\Text;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WordManagerSpec extends ObjectBehavior
{
    function let(EntityManager $em, EntityRepository $repository){
        $this->beConstructedWith($em);

        $em->getRepository('AppBundle:Word')->willReturn($repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Manager\WordManager');
    }

    function it_generate_words_from_a_given_text(Text $text)
    {
        $text->getParts()->willReturn(array()); // Skip
        $text->getOccurrences()->willReturn(array('w1' => 3, 'w2' => 1));

        $this->getWords()->shouldHaveCount(0);

        $this->generateFromText($text, false);

        $this->getWords()->shouldHaveCount(2);
        $this->getWords()->first()->shouldHaveType('AppBundle\Entity\Word');
        $this->getWords()->first()->getValue()->shouldReturn('w1');
        $this->getWords()->first()->getCount()->shouldReturn(3);
    }

    function it_should_generate_links_from_text(Text $text)
    {
        $text->getParts()->willReturn(array('w1', 'w2', 'w1', 'w3', 'w1'));
        $text->getOccurrences()->willReturn(array('w1' => 3, 'w2' => 1, 'w3' => 1));

        $this->generateFromText($text, false);

        $this->getLinks()->shouldHaveCount(4);
        $this->getLinks()->first()->shouldHaveType('AppBundle\Entity\Link');

        $this->getLinks()->first()->getWord1()->getValue()->shouldReturn('w1');
        $this->getLinks()->first()->getWord2()->getValue()->shouldReturn('w2');

        $this->getLinks()->last()->getWord1()->getValue()->shouldReturn('w3');
        $this->getLinks()->last()->getWord2()->getValue()->shouldReturn('w1');

    }

    function it_should_count_links(Text $text)
    {
        $text->getParts()->willReturn(array('w1', 'w2', 'w1', 'w2', 'w1'));
        $text->getOccurrences()->willReturn(array('w1' => 3, 'w2' => 2));

        $this->generateFromText($text, false);

        $this->getLinks()->shouldHaveCount(2);

        $this->getLinks()->first()->getWord1()->getValue()->shouldReturn('w1');
        $this->getLinks()->first()->getWord2()->getValue()->shouldReturn('w2');

        $this->getLinks()->last()->getWord1()->getValue()->shouldReturn('w3');
        $this->getLinks()->last()->getWord2()->getValue()->shouldReturn('w1');

    }
}
