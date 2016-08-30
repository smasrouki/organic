<?php

namespace AppBundle\Command;

use AppBundle\Entity\Word;
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
        // Content
        $filename = 'data/ref.txt';
        if (file_exists($filename)) {
            $content = file_get_contents($filename);
        }

        // Text
        $text = new Text($content, ' ');

        // Words
        $wordManager = $this->getContainer()->get('word_manager');

        // Words: Clean
        $wordManager->removeAll();

        // Words: Create
        foreach($text->getParts() as $value){
            $count = $text->getCount($value);

            $wordManager->create($value, $count);
        }

        $wordManager->flush();
    }
}
