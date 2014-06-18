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

        $debug = in_array($this->container->get('kernel')->getEnvironment(), array('test', 'dev'));
        $maintenance = file_exists($path.'/../onMaintenance');

        if ($maintenance && !$debug) {
            throw new ServiceUnavailableHttpException();
		}
	}
}