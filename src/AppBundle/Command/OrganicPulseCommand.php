<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use AppBundle\Entity\Package;
use AppBundle\Entity\Word;

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
        $packageManager = $this->getContainer()->get('package_manager');

        // Table Helper
        $table = $this->getHelper('table');
        $table->setHeaders(array('Word', 'Count', 'Type'));

        /**
         * @var $package Package
         */
        foreach($packageManager->getRepository()->findAll() as $package){
            /**
             * @var $word Word
             */
            foreach($package->getWords() as $word){
                $table->addRow(array($word->getValue(), $word->getCount(), $word->getTypeLabel()));
            }

            $table->addRow(array('----------------', '----------------', '----------------'));
        }

        $table->render($output);
    }
}
