<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Component\Text\Text;

class OrganicImportFileCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('organic:import:file')
            ->setDescription('...')
            ->addArgument('filename', InputArgument::REQUIRED, 'Filename')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filename = $input->getArgument('filename');

        if (!file_exists($filename)) {
            $output->writeln("<error>$filename does not exist</error>");
            exit();
        }

        $content = file_get_contents($filename);

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

        $output->writeln("<info>File imported successfully</info>");
    }
}
