<?php
namespace Smurfy\CommonBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class onMaintenanceCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('common:maintenance:on')
            ->setDescription('Enable maintenance')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if(!file_exists($this->getContainer()->get('kernel')->getRootDir().'onMaintenance')) {
            $fp = fopen($this->getContainer()->get('kernel')->getRootDir().'onMaintenance', 'w');
            fwrite($fp, '1');
            fclose($fp);
        } else {
            throw new \Exception('Maintenance is already enabled.');
        }

        $em = $this->getContainer()->get('doctrine')->getManager();
        $log_content = '[MAINTENANCE] ON';
        $this->getContainer()->get('smurfy.logger')->log(null, null, null, $log_content);

        $output->writeln('Maintenance enabled.');
    }
}