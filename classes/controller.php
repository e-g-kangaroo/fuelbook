<?php

namespace Fuelbook;

class Controller extends \Controller
{
	public static function _init()
	{
		\Autoloader::load('Facebook');
	}
}