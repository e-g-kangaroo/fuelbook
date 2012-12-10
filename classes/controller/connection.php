<?php

namespace Fuelbook;

class Controller_Connection extends Controller
{

	protected $facebook = null;

	public function before()
	{
		$this->_status();

		\Log::info('Access token: '.Facebook::get_access_token());
	}

	public function action_status()
	{
		return $this->_status();
	}

	public function action_login()
	{
		$login_url = Facebook::get_login_url(array(
			'scope' => \Config::get('fuelbook.scope', 'user_about_me'),
			'redirect_uri' => \Uri::create(\Config::get('fuelbook.callback', 'fuelbook/callback'))
		));

		\Log::info('Facebook login url: '.$login_url);

		\Response::redirect($login_url, 'refresh', 200);
	}

	public function action_logout()
	{
		\Session::delete('fuelbook_user_id');
		\Response::redirect(\Uri::create(\Config::get('fuelbook.logout.redirect', '/')), 'refresh', 200);
	}

	public function action_callback()
	{
		if ( ! Facebook::get_user() ) {
			Facebook::destroy_session();
			\Response::redirect( \Uri::create(\Config::get('fuelbook.error.redirect', '/')), 'refresh', 200 );
		}

		Model_Autosave::user();
		\Session::set('fuelbook_user_id', Facebook::get_user());
		\Response::redirect( \Uri::create(\Config::get('fuelbook.login.redirect', '/')), 'refresh', 200 );
	}

	protected function _status()
	{
		return (bool) static::facebook_id();
	}
}
