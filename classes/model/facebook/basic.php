<?php

namespace Fuelbook;

class Model_Facebook_Basic extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'facebook_id',
		'display_name',
		'first_name',
		'last_name',
		'page_url',
		'created_at',
		'updated_at'
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);
}
