<?php

return array(
	'app_id'     => 'Your app id',
	'app_secret' => 'Your secret token',

	/**
	 * Facebook PHP SDK path.
	 *
	 * Clone example)
	 * git submodule add git://github.com/facebook/facebook-php-sdk.git fuel/app/vendor/facebook
	 */
	'sdk_path'   => APPPATH.'vendor'.DS.'facebook'.DS.'src',

	/**
	 * see https://developers.facebook.com/docs/reference/login/#permissions
	 */
	'scope'      => 'user_about_me'
);