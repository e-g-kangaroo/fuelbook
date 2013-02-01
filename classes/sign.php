<?php

namespace Fuelbook;

class Sign
{
	protected static $signed_request = null;

	public static function _init()
	{
		static::$signed_request = Facebook::get_signed_request();

		if ( ! static::$signed_request )
		{
			\Log::info('Try to load signed_request from session "'.self::_sess_signed_request().'"');
			static::$signed_request = \Session::get(self::_sess_signed_request(), false);
		}
		else
		{
			\Session::set(self::_sess_signed_request(), static::$signed_request);
		}
	}

	public static function is_signed($in_param = false)
	{
		if ( ! $in_param )
		{
			return (boolean) static::$signed_request;
		}
		else
		{
			return (boolean) isset($_GET['signed_request']) or (boolean) isset($_POST['signed_request']);
		}
	}

	public static function get($name)
	{
		$name_hierarchy = explode('.', $name);
		$current_object = (array) static::$signed_request;

		foreach ($name_hierarchy as $name)
		{
			if ( isset($current_object[$name]) )
			{
				$current_object = $current_object[$name];
				if ( is_object($current_object))
				{
					$current_object = (array) $current_object;
				}
			}
			else
			{
				return false;
			}
		}

		return $current_object;
	}

	public static function signed_request()
	{
		return static::$signed_request;
	}

	public static function abrogate()
	{
		\Session::set(self::_sess_signed_request(), false);
	}

	protected static function _sess_signed_request()
	{
		return \Config::get('fuelbook.session.signed_request', '_sess_fuelbook_signed_request');
	}
}