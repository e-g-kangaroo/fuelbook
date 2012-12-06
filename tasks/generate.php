<?php

namespace Fuel\Tasks;

class Generate
{

	public static function basics()
	{
		\Oil\Generate::migration(array(
			'create_facebook_basics',
			'facebook_id:string',
			'display_name:string',
			'first_name:string',
			'last_name:string',
			'page_url:string',
			'created_at:int',
			'updated_at:int'
		));
	}
}
