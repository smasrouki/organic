<?php

namespace AppBundle\Manager;


use AppBundle\Entity\Package;
use Doctrine\Common\Collections\Collection;

class PackageManager extends BaseManager
{
    protected function getEntityName()
    {
        return 'AppBundle:Package';
    }


    public function create($words)
    {
        $package = new Package();

        foreach($words as $word){
            $package->addWord($word);
        }

        $this->persist($package);

        return $package;
    }

    public function removeAll()
    {
        $this->em->getRepository('AppBundle:Word')
            ->createQueryBuilder('w')
            ->update()
            ->set('w.package', ':package')
            ->setParameter('package', null)
            ->getQuery()
            ->execute();

        parent::removeAll();
    }


}