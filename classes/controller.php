<?php

namespace Fuelbook;

class Controller extends \Controller
{
	public static function _init()
	{
		\Autoloader::load('Facebook');
	}

	public static function facebook_id()
	{
		return \Session::get('fuelbook_user_id');
	}

	public static function destroy()
	{
		\Session::delete('fuelbook_user_id');
	}
}