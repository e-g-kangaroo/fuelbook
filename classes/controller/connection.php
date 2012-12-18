<?php

namespace Fuelbook;

class Controller_Connection extends Controller
{

	protected $facebook = null;

	public function before()
	{
		$this->_status();
	}

	public function action_status()
	{
		return $this->_status();
	}

	public function action_login()
	{
		Status::destroy();

		$login_url = Facebook::get_login_url(array(
			'scope' => \Config::get('fuelbook.scope', 'user_about_me'),
			'redirect_uri' => \Uri::create(\Config::get('fuelbook.callback', 'fuelbook/callback'))
		));

		if ( $user = Facebook::get_user() ) {
			\Log::warn("User ({$user}) is already logged in with Facebook.");
		}

		\Response::redirect($login_url, 'refresh', 200);
	}

	public function action_logout()
	{
		Status::destroy();
		\Response::redirect(\Uri::create(\Config::get('fuelbook.logout.redirect', '/')), 'refresh', 200);
	}

	public function action_callback()
	{
		\Log::info('Code sample: '.Facebook::get_signed_request());

		if ( ! Facebook::get_user() )
		{
			\Log::error('Facebook login failure ()');
			Status::destroy();
			\Response::redirect( \Uri::create(\Config::get('fuelbook.error.redirect', '/')), 'refresh', 200 );
		}

		Status::set_access_token(Facebook::get_access_token());
		Status::set_facebook_id(Facebook::get_user());

		Facebook::destroy_session();

		Model_Autosave::user();

		\Response::redirect( \Uri::create(\Config::get('fuelbook.login.redirect', '/')), 'refresh', 200 );
	}

	protected function _status()
	{
		return (bool) Status::get_facebook_id();
	}
}
