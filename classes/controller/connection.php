<?php

namespace Fuelbook;

class Controller_Connection extends Controller
{

	protected $facebook = null;
	protected $user = null;

	public function before()
	{
		$this->facebook = Facebook::instance();
	}

	public function action_status()
	{
		return $this->_status();
	}

	public function action_login()
	{
		$login_url = $this->facebook->getLoginUrl(array(
			'scope' => 'user_about_me',
			'redirect_uri' => \Uri::create(\Config::get('fuelbook.callback', 'fuelbook/callback'))
		));

		\Response::redirect($login_url, 'refresh');
	}

	public function action_logout()
	{
		$logout_url = $this->facebook->getLogoutUrl(array(
			'scope' => 'user_about_me',
			'redirect_uri' => \Uri::create(\Config::get('fuelbook.callback', 'fuelbook/callback'))
		));

		\Response::redirect($logout_url, 'refresh');
	}

	public function action_callback()
	{
		if ( $this->_status() ) {
			$redirect_uri = \Config::get('fuelbook.login.redirect', '/');
		}
		else {
			$redirect_uri = \Config::get('fuelbook.logout.redirect', '/');
		}

		\Response::redirect( \Uri::create($redirect_uri) );
	}

	protected function _status()
	{
		if ( is_null($this->user) )
		{
			$user = $this->facebook->getUser();
		}

		return (bool) $user;
	}
}
