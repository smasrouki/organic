<?php

namespace AppBundle\Command;

use AppBundle\Entity\Word;
use Component\Object\Decorator;
use Component\Object\Link;
use Component\Object\Object;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class OrganicCrawlCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('organic:crawl')
            ->setDescription('...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Input / Ouput
        $io = new SymfonyStyle($input, $output);
        $headers = array('Type', 'Value', 'Process', 'Status');

        // Managers
        $wordManager = $this->getContainer()->get('word_manager');

        // Vars
        $originalString = '';
        $compare = 'OK';
        $decorator = null;
        $link = null;
        $object = null;
        $proxy = null;
        $current = null;

        /**
         * @var $word Word
         */
        foreach ($wordManager->getRepository()->findAll() as $word){
            $value = $word->getValue();
            if($originalString != ''){
                $originalString .= ' ';
            }
            $originalString .= $value;

            switch($word->getType()){
                case Word::TYPE_DECORATOR:
                    if($decorator){
                        $newDecorator =  new Decorator($value);
                        $decorator->setSubject($newDecorator);
                    } else {
                        $decorator = new Decorator($value);
                    }

                    break;
                case Word::TYPE_LINK:

                    if($link){
                        $newLink = new Link($value);
                        $link->setSubject($newLink);
                    } else {
                        $link = new Link($value);
                    }

                    if($current){
                        $link->setPreset($current);
                    }

                    $current = $link;

                    break;
                case Word::TYPE_OBJECT:
                    $object = new Object($value);

                    if($decorator){
                        $decorator->setSubject($object);

                        if($current){
                            $current = $current->toProxy();
                            $current->addComplement($decorator);
                            $link = null;
                        } else {
                            $current = $decorator;
                        }

                        $decorator = null;
                    } elseif ($link){
                        $link->setSubject($object);
                        $current = $link;
                        $link = null;
                    } elseif ($current) {
                        $current = $current->toProxy();
                        $current->addComplement($object);
                    }

                    if($current){
                        $compare = $originalString == $current->process() ? 'OK' : 'ERROR';
                    }

                    break;
            }
            $io->section($word->getValue().' ('.$word->getTypeLabel().')');
            if($current){
                $rows = array(array(get_class($current), $current->getValue(), $current->process(), $compare));
                $io->table($headers, $rows);
            }

            // Continue
            $continue = $io->confirm('Continue ?');

            if(false === $continue){
                break;
            }
        }
    }

}
