<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use AppBundle\Entity\Package;
use AppBundle\Entity\Word;

class OrganicDumpCommand  extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('organic:dump')
            ->setDescription('...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $packageManager = $this->getContainer()->get('package_manager');
        $data = '';

        /**
         * @var $package Package
         */
        foreach($packageManager->getRepository()->findAll() as $package){
            /**
             * @var $word Word
             */
            foreach($package->getWords() as $word){
                $row = $package->getId().';'.$word->getValue().';'.$word->getCount().';'.$word->getType();
                $data .= $row."\n";
            }
        }

        file_put_contents('dump.csv', $data);

        $output->writeln("<info>Dump successful</info>");
    }
}