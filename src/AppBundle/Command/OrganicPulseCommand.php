<?php

namespace AppBundle\Command;

use AppBundle\Entity\Package;
use Component\Text\Text;
use Component\Text\WordPackager;
use Doctrine\Common\Collections\ArrayCollection;
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
        // Managers
        $wordManager = $this->getContainer()->get('word_manager');
        $packageManager = $this->getContainer()->get('package_manager');

        // Packages: Clean
        $packageManager->removeAll();

        // Word Packager
        $words = new ArrayCollection($wordManager->getRepository()->findAll());
        $wordPackager = new WordPackager($words);

        // Packages
        foreach($wordPackager->getPackages() as $words){
            $packageManager->create($words);
        }

        $packageManager->flush();
    }
}
