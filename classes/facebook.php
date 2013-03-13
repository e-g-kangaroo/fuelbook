<?php

namespace Fuelbook;

class Facebook
{

	private static $instance;
	private static $facebook;

	public static function _init()
	{
		if ( ! class_exists('\\Facebook') )
		{
			\Autoloader::load('Fuelbook\\Sdk');
		}

		static::$instance = new static();
		static::reload();
	}

	public static function instance()
	{
		return static::$instance;
	}

	private function __construct()
	{
		static::$facebook = new \Facebook(array(
			'appId'  => \Config::get('fuelbook.app_id'),
			'secret' => \Config::get('fuelbook.app_secret')
		));

		if ( Status::get_access_token() )
		{
			static::$facebook->setAccessToken( Status::get_access_token() );
			static::$facebook->setExtendedAccessToken();
			$access_token = $this->api->getAccessToken();

			if ( $access_token )
			{
				Status::set_access_token("access_token", $access_token );
				static::$facebook->setAccessToken( $access_token );
			}

			static::$facebook->setAccessToken( Status::get_access_token() );
		}

		static::$facebook->getUser();
	}

	public function __call($name, $args)
	{
		$fragments = explode('_', $name);

		$correct_name = array_shift($fragments);

		foreach ($fragments as $piece) {
			$correct_name .= ucfirst($piece);
		}

		if ( is_callable($callback = array(static::$facebook, $correct_name))) {
			return call_user_func_array($callback, $args);
		}

		throw new \Exception("Method {$correct_name}() is not found in Facebook class and Fuelbook\\Facebook class.");
	}

	public static function __callStatic($name, $args)
	{
		return call_user_func_array(array(static::instance(), $name), $args);
	}

	public static function reload()
	{
		// Restore access token from fuel-php session.
		if ( $access_token = Status::get_access_token() ) {
			static::set_access_token($access_token);
		}
	}
}