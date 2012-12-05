<?php

namespace Fuelbook;

class Controller extends \Controller
{
	public static function _init()
	{
		\Autoloader::load('Fuelbook\\Sdk');
		\Autoloader::load('Fuelbook\\Facebook');
	}
}