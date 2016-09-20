<?php

namespace AppBundle\Command;

use AppBundle\Entity\Word;
use Component\Object\Decorator;
use Component\Object\Link;
use Component\Object\Object;
use Component\Object\Pointer;
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
        // TODO Decorator push/pop + string compare + l affliction/ enoch ame juste
        // Input / Ouput
        $io = new SymfonyStyle($input, $output);
        $headers = array('Type', 'Value', 'Process');

        // Managers
        $wordManager = $this->getContainer()->get('word_manager');

        // Vars
        $pointer = null;
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

            switch($word->getType()){
                case Word::TYPE_POINTER:
                    $pointer = new Pointer($value);
                    break;
                case Word::TYPE_DECORATOR:
                    if($decorator){
                        $newDecorator =  new Decorator($value);
                        $decorator->setSubject($newDecorator);
                        $decorator = $newDecorator;
                        dump($decorator);
                    } else {
                        $decorator = new Decorator($value);
                    }

                    break;
                case Word::TYPE_LINK:
                    $link = new Link($value);
                    $link->setPreset($current);
                    break;
                case Word::TYPE_OBJECT:
                    $object = new Object($value);
                    if($decorator){
                        $decorator->setSubject($object);
                        if($pointer){
                            $pointer->setSubject($decorator);
                            $current = $pointer;
                            $pointer = null;
                        } elseif($proxy) {
                            $current->addComplement($decorator);
                        } else {
                            $current = $proxy = $current->toProxy();
                            $current->addComplement($decorator);
                        }

                        $decorator = null;
                    } elseif($link){
                        $link->setSubject($object);
                        $current = $link;
                        $link = null;
                        $proxy = null;
                    } else {
                        dump($object);exit();
                    }

                    break;
            }
            $io->section($word->getValue().' ('.$word->getTypeLabel().')');
            if($current){
                $rows = array(array(get_class($current), $current->getValue(), $current->process()));
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
