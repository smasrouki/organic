<?php

namespace spec\AppBundle\Manager;

use AppBundle\Manager\LinkManager;
use Component\Text\Text;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WordManagerSpec extends ObjectBehavior
{
    function let(EntityManager $em, LinkManager $linkManager, EntityRepository $repository){
        $this->beConstructedWith($em, $linkManager);

        $em->getRepository('AppBundle:Word')->willReturn($repository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Manager\WordManager');
    }

    function it_generate_words_from_a_given_text(Text $text, LinkManager $linkManager)
    {
        $text->getParts()->willReturn(array('w1', 'w2', 'w1', 'w1'));
        $text->getOccurrences()->willReturn(array('w1' => 3, 'w2' => 1));

        $this->getWords()->shouldHaveCount(0);

        $this->generateFromText($text, false);

        $linkManager->generate(Argument::any(), Argument::any())->shouldHaveBeenCalled();

        $this->getWords()->shouldHaveCount(2);
        $this->getWords()->first()->shouldHaveType('AppBundle\Entity\Word');
        $this->getWords()->first()->getValue()->shouldReturn('w1');
        $this->getWords()->first()->getCount()->shouldReturn(3);
    }

    function it_should_use_links_from_link_manager(LinkManager $linkManager)
    {
        $this->getLinks();

        $linkManager->getLinks()->shouldHaveBeenCalled();
    }
}
