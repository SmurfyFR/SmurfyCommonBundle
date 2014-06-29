<?php

namespace Smurfy\CommonBundle\Listener;

use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

class Maintenance
{
	protected $container;

    public function __construct($container) {
        $this->container = $container;
    }

	public function onKernelRequest(GetResponseEvent $event)
	{
		if (HttpKernel::MASTER_REQUEST != $event->getRequestType()) {
            return;
        }

        $path = $this->container->getParameter('kernel.root_dir');

        // Maintenance
        $debug = in_array($this->container->get('kernel')->getEnvironment(), array('test', 'dev'));
        $maintenance = file_exists($path.'/../onMaintenance');

        if ($maintenance && !$debug) {
            throw new ServiceUnavailableHttpException();
		}

        // Display Message
        if(is_file($path.'/../message.txt') AND !$debug) {
            $msg = file_get_contents($path.'/../message.txt');
            $this->container->get('session')
                            ->getFlashBag()
                            ->add('warning', $msg);
        }
	}
}