<?php

namespace AppBundle\Command;

use AppBundle\Entity\Package;
use Component\Text\Text;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class OrganicPulseCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('organic:pulse')
            ->setDescription('...')
            //->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            //->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Entity manager
        $em = $this->getContainer()->get('doctrine.orm.default_entity_manager');

        // Managers
        $wordManager = $this->getContainer()->get('word_manager');
        $packageManager = $this->getContainer()->get('package_manager');

        // Packages: Clean
        $packageManager->removeAll();

        // Packages: Array
        $lastCount = 0;

        $packages = array();
        $packageCount = 1;
        $packages[$packageCount] = array();

        foreach($wordManager->getRepository()->findAll() as $word)
        {
            if($lastCount && $word->getCount() > $lastCount){
                $packageCount++;
                $packages[$packageCount] = array();
            }

            $packages[$packageCount][] = $word;
            $lastCount = $word->getCount();
        }

        // Packages: Objects
        foreach($packages as $words){
            $packageManager->create($words);
        }

        $em->flush();
    }
}
