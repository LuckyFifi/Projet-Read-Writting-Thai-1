<?php
// src/Rw/UserBundle/Entity/User.php

namespace Rw\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
//use FOS\UserBundle\Model\User as BaseUser;

// @ORM\MappedSuperClass

/**
 * @ORM\Table(name="myuser")
 * @ORM\Entity
 */
class User extends BaseUser
{
   /**
    * @ORM\Column(name="id", type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
	protected $id;
	
	public function __construct()
  {
	parent::__construct();
    $this->roles = array('ROLE_USER');
  }
}