<?php

namespace AppBundle\Command;

use Component\Text\Text;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class OrganicTestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('organic:test')
            ->setDescription('...')
//            ->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
//            ->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if(file_exists('data/ref.txt')){
            $text = new Text(file_get_contents('data/ref.txt'), ' ');

            $this->getContainer()->get('word_manager')->generateFromText($text);
        }
    }

}
