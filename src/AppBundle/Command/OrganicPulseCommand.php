<?php

namespace AppBundle\Command;

use AppBundle\Service\Pulse;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

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
    	$helper = $this->getHelper('question');

        do{

            $context = $this->getContainer()->get('context.initial');

            $pulse = new Pulse($context);

            $text = $pulse->getText();

            $question = new Question($text."\n");
            $response = $helper->ask($input, $output, $question);
        } while($response);


        $output->writeln('End');
    }

}
