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
		return \Session::get('fuekbook_user_id');
	}
}