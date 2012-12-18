<?php

namespace Fuelbook;

class Status
{

	protected static $_val = null;

	public static function get_facebook_id()
	{
		return \Session::get(static::_sess_id(), false);
	}

	public static function set_facebook_id($facebook_id)
	{
		\Session::set(static::_sess_id(), $facebook_id);
	}

	public static function get_access_token()
	{
		return \Session::get(static::_sess_token(), false);
	}

	public static function set_access_token($access_token)
	{
		\Session::set(static::_sess_token(), $access_token);
	}

	public static function destroy()
	{
		Facebook::destroy_session();
		\Session::delete(static::_sess_id());
		\Session::delete(static::_sess_token());
	}

	public static function is_canvas()
	{
		if ( empty(static::$_val) ) { 
			static::$_val = \Validation::forge('fuelbook');
			static::$_val->add_field('signed_request', 'Signed Request', 'required');
		}

		return static::$_val->run();
	}

	protected static function _sess_id()
	{
		return \Config::get('fuelbook.session.id', '_sess_fuelbook_id');
	}

	protected static function _sess_token()
	{
		return \Config::get('fuelbook.session.token', '_sess_fuelbook_token');
	}
}