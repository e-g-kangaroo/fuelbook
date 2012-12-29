<?php

namespace Fuelbook;

class Model_Graph_User extends Model_Graph
{
	protected static $_graph_path = '/%s?fields=picture,id,name,first_name,last_name,link,username,birthday,gender';
	protected static $_properties = array(
		'id',
		'name',
		'first_name',
		'last_name',
		'link',
		'username' => array('default' => ''),
		'birthday' => array('default' => ''),
		'gender' => array('default' => ''),
		'picture' => array('path' => 'picture/data/url'),
		'picture_square' => array('default' => null),
	);

	protected function get_picture_square()
	{
		static $tried = false;

		if ( ! $tried )
		{
			$tried = true;
			$return = (array) Facebook::api( sprintf('/%s?fields=picture.type(square)', (string) $this->id));

			if ( isset($return['picture']['data']['url']) )
			{
				$this->set('picture_square', $return['picture']['data']['url']);
			}
		}

		return $this->get('picture_square');
	}

	protected static $_table = 'facebook_graph_user';
}