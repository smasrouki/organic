<?php

namespace AppBundle\Command;

use AppBundle\Entity\Word;
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

        // Table Helper
        $table = $this->getHelper('table');
        $table->setHeaders(array('Word', 'Count', 'Type'));

        /**
         * @var $word Word
         */
        foreach($wordManager->getRepository()->findAll() as $word){
            $table->addRow(array($word->getValue(), $word->getCount(), $word->getTypeLabel()));
        }

        $table->render($output);
    }
}
