<?php

namespace Fuelbook;

class Model_Graph_User extends Model_Graph
{
	protected static $_graph_path = '/me';
	protected static $_properties = array(
		'id',
		'name',
		'first_name',
		'last_name',
		'link',
		'username',
		'birthday',
	);

	protected static $_table = 'facebook_graph_user';
}