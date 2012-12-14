<?php

namespace Fuelbook;

class Status
{

	public static function get_facebook_id()
	{
		\Log::info('Get facebook id: '.var_export(\Session::get('fuelbook_user_id', false), true));
		return \Session::get('fuelbook_user_id', false);
	}

	public static function set_facebook_id($facebook_id)
	{
		\Log::info('Set facebook id: '.var_export($facebook_id, true));
		\Session::set('fuelbook_user_id', $facebook_id);
		\Session::write();
	}

	public static function destroy()
	{
		\Log::info('Destroy facebook id');
		Facebook::destroy_session();
		\Session::delete('fuelbook_user_id');
	}
}