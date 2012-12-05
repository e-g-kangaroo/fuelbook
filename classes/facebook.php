<?php

namespace Fuelbook;

class Facebook extends \Facebook
{

	private static $instance;

	public static function _init()
	{
		self::$instance = new static(array(
			'appId'  => \Config::get('fuelbook.app_id'),
			'secret' => \Config::get('fuelbook.app_secret')
		));
	}

	public static function instance()
	{
		return self::$instance;
	}
}