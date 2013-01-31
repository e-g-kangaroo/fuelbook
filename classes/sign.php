<?php

namespace Fuelbook;

class Sign
{
	protected static $signed_request = null;

	public static function _init()
	{
		static::$signed_request = Facebook::get_signed_request();
	}

	public static function is_signed()
	{
		return (boolean) static::$signed_request;
	}

	public static function get($name)
	{
		$name_hierarchy = explode('.', $name);
		$current_object = (array) static::$signed_request;

		foreach ($name_hierarchy as $name)
		{
			if ( isset($current_object[$name]) )
			{
				$current_object = (array) $current_object[$name];
			}
		}

		return $current_object;
	}
}