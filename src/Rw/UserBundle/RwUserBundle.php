<?php
// src/Rw/UserBundle/RwUserBundle.php

namespace Rw\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RwUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
