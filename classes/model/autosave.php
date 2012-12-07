<?php

namespace Fuelbook;

class Model_Autosave extends \Model
{
	public static function user()
	{
		$user_id = \Session::get('fuelbook_user_id', false);

		/**
		 * Auto save for session.
		 */
		if ( $user_id === false ) {
			\Session::set('fuelbook_user_id', $user_id = Facebook::get_user());
		}

		/**
		 * Auto save for database.
		 */
		$count_query = array(
			'select' => 'id',
			'where' => array('facebook_id' => $user_id)
		);

		if ( Model_Facebook_Basic::count($count_query) == 0 )
		{
			$user_profile = (object) Facebook::api('/me');

			$user = new Model_Facebook_Basic(array(
				'facebook_id' => $user_id,
				'display_name' => $user_profile->name,
				'first_name' => $user_profile->first_name,
				'last_name' => $user_profile->last_name,
				'page_url' => $user_profile->link
			));
			$user->save();
		}
	}
}