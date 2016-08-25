<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Link;

/**
 * Link controller.
 *
 * @Route("/link")
 */
class LinkController extends Controller
{
    /**
     * Lists all Link entities.
     *
     * @Route("/", name="link_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $links = $em->getRepository('AppBundle:Link')->findAll();

        return $this->render('link/index.html.twig', array(
            'links' => $links,
        ));
    }

    /**
     * Finds and displays a Link entity.
     *
     * @Route("/{id}", name="link_show")
     * @Method("GET")
     */
    public function showAction(Link $link)
    {

        return $this->render('link/show.html.twig', array(
            'link' => $link,
        ));
    }
}
