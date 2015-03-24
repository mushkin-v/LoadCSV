<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\Yaml\Yaml;

class ParseYmlCommand extends ContainerAwareCommand
{
        protected function configure()
    {
                $this
                    ->setName('app:parse-yml')
                    ->setDescription('Parse fixtures yml to csv')
                ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $name ='fixturesEmployeeTranslation_ua';
        $csv =  fopen(__DIR__.'/../../../web/uploads/'.$name.'.csv', 'w');
        $yml =  __DIR__.'/../DataFixtures/ORM/'.$name.'.yml';
        $array = Yaml::parse(file_get_contents($yml));

        foreach ($array as $fields) {
            foreach ($fields as $field) {
                fputcsv($csv, $field);
            }
        }

        fclose($csv);

        $output->writeln('Parse was successful');
    }
}