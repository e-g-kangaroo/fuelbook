<?php

namespace Fuelbook;

class Model_Autosave extends \Model
{
	public static function user()
	{
		$user_id = Status::get_facebook_id();

		/**
		 * Auto save for database.
		 */
		$count_query = array(
			'select' => 'facebook_id',
			'where' => array('facebook_id' => $user_id)
		);

		if ( Model_Facebook_Basic::count($count_query) == 0 )
		{
			$user_profile = (object) Facebook::api('/me');

			$user = new Model_Facebook_Basic(array(
				'facebook_id' => $user_id,
				'name' => $user_profile->name,
				'first_name' => $user_profile->first_name,
				'last_name' => $user_profile->last_name,
				'link' => $user_profile->link
			));
			$user->save();
		}
	}
}