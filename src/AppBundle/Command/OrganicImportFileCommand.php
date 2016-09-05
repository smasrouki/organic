<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Doctrine\Common\Collections\ArrayCollection;

use Component\Text\Text;
use Component\Text\WordPackager;

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

        // Managers
        $wordManager = $this->getContainer()->get('word_manager');
        $packageManager = $this->getContainer()->get('package_manager');

        // Clean
        $packageManager->removeAll();
        $wordManager->removeAll();

        // Words
        $words = new ArrayCollection();

        foreach($text->getParts() as $value){
            $count = $text->getCount($value);

            $word = $wordManager->create($value, $count);

            $words->add($word);
        }

        $wordManager->flush();

        // Packages
        $wordPackager = new WordPackager($words);

        foreach($wordPackager->getPackages() as $words){
            $packageManager->create($words);
        }

        $packageManager->flush();

        $output->writeln("<info>File imported successfully</info>");
    }
}
