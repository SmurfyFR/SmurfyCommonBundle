<?php
namespace Smurfy\CommonBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class offMaintenanceCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('common:maintenance:off')
            ->setDescription('Disable maintenance')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if(file_exists($this->getContainer()->get('kernel')->getRootDir().'onMaintenance')) {
            unlink($this->getContainer()->get('kernel')->getRootDir().'onMaintenance');
        } else {
            throw new \Exception('Maintenance is already disabled.');
        }

        $em = $this->getContainer()->get('doctrine')->getManager();
        $log_content = '[MAINTENANCE] OFF';
        $this->getContainer()->get('smurfy.logger')->log(null, null, null, $log_content);

        $output->writeln('Maintenance disabled.');
    }
}