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
        $text->getOccurrences()->willReturn(array('w1' => 3, 'w2' => 1));

        $this->getWords()->shouldHaveCount(0);

        $this->generateFromText($text, false);

        $this->getWords()->shouldHaveCount(2);
        $this->getWords()->first()->shouldHaveType('AppBundle\Entity\Word');
        $this->getWords()->first()->getValue()->shouldReturn('w1');
        $this->getWords()->first()->getCount()->shouldReturn(3);
    }
}
