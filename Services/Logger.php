<?php
namespace Smurfy\CommonBundle\Services;

use Smurfy\CommonBundle\Entity\Log;

class Logger {

	protected $doctrine;

	public function __construct($doctrine)
	{
		$this->doctrine = $doctrine;
	}

    /*
    *   @usage : ->log($user->getId(), $user->getUsername(), $request->getClientIp(), $content) for normal clients
    *   @usage : ->log(null, null, null, $content) for system
    */
	public function log($user_id, $user_name, $user_ip, $content)
	{
		$log = new Log;

		$log->setUserId($user_id);
		$log->setUserName($user_name);
		$log->setUserIp($user_ip);
		$log->setContent($content);

		$em = $this->doctrine->getManager();
		$em->persist($log);
		$em->flush();
	}
}