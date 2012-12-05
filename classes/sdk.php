<?php

namespace Fuelbook;

class Sdk
{

	/**
	 *
	 *
	 * - Include facebook core.
	 */
	public static function _init()
	{
		\Config::load('fuelbook', true);

		$sdk_path = \Config::get('fuelbook.sdk_path');

		require_once $sdk_path.DS.'facebook.php';
	}
}