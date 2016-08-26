<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class OrganicContextCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('organic:context')
            ->setDescription('Context explorer')
            ->addArgument('context', InputArgument::REQUIRED, 'Context name')
            ->addOption('value', null, InputOption::VALUE_OPTIONAL)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $contextName = $input->getArgument('context');

        $helper = $this->getHelper('question');

        $response = null;

        do{
            try{
                $context = $this->getContainer()->get($contextName);
            } catch (\Exception $e) {
                $output->writeln('"'.$contextName.'" does not exist !');
                exit();
            }

            if($response){
                $context->update($response);
            } elseif($input->getOption('value')){
                $context->update($input->getOption('value'));
            }

            $text = '';
            $word = null;

            do{
                $word = $context->getWord($word);

                if($word){
                    $text .= $word->getValue().' ';
                }
            } while ($word);

            $question = new Question($text."\n");
            $response = $helper->ask($input, $output, $question);
        } while($response);
    }

}
