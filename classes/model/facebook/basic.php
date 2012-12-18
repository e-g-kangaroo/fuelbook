<?php

namespace Fuelbook;

class Model_Facebook_Basic extends \Orm\Model
{
	protected static $_properties = array(
		'facebook_id',
		'name',
		'first_name',
		'last_name',
		'link',
		'created_at',
		'updated_at'
	);

	protected static $_primary_key = array('facebook_id');

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
