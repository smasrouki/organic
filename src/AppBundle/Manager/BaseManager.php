<?php

namespace AppBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class BaseManager Abstract entity manager
 *
 * @package AppBundle\Manager
 */
abstract class BaseManager
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * WordManager constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return EntityRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository($this->getEntityName());
    }

    /**
     * Persist an entity
     *
     * @param $entity
     */
    public function persist($entity)
    {
        $this->em->persist($entity);
    }

    /**
     * Flush entities
     */
    public function flush()
    {
        $this->em->flush();
    }

    /**
     * Remove all entities
     *
     * @return mixed
     */
    public function removeAll()
    {
        return $this->getRepository()
            ->createQueryBuilder('e')
            ->delete()
            ->getQuery()
            ->execute();
    }

    /**
     * @return string
     */
    protected abstract function getEntityName();
}