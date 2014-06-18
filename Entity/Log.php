<?php

namespace Smurfy\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Log
 *
 * @ORM\Table(name="core_log")
 * @ORM\Entity
 */
class Log
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
     */
    private $datetime;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $user_id;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=40, nullable=true)
     */
    private $user_name;

    /**
     * @var string
     *
     * @ORM\Column(name="user_ip", type="string", length=40, nullable=true)
     */
    private $user_ip;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

	/** Constructeur **/
	public function __construct()
    {
		$this->datetime = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     * @return Log
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set user_id
     *
     * @param integer $userId
     * @return Log
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set user_name
     *
     * @param string $userName
     * @return Log
     */
    public function setUserName($userName)
    {
        $this->user_name = $userName;

        return $this;
    }

    /**
     * Get user_name
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * Set user_ip
     *
     * @param string $userIp
     * @return Log
     */
    public function setUserIp($userIp)
    {
        $this->user_ip = $userIp;

        return $this;
    }

    /**
     * Get user_ip
     *
     * @return string
     */
    public function getUserIp()
    {
        return $this->user_ip;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Log
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }


    public function __toString()
    {
        return 'Log : '.$this->getId() ?: '-';
    }
}
