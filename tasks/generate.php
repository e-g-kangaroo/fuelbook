<?php

namespace Fuel\Tasks;

class Generate
{

	public static function basics()
	{
		\DBUtil::create_table('facebook_basics', array(
			'facebook_id' => array('type' => 'varchar', 'constraint' => 15),
			'display_name' => array('type' => 'varchar', 'constraint' => 64),
			'first_name' => array('type' => 'varchar', 'constraint' => 32),
			'last_name' => array('type' => 'varchar', 'constraint' => 32),
			'page_url' => array('type' => 'varchar', 'constraint' => 200),
			'created_at' => array('type' => 'int', 'constraint' => 11),
			'updated_at' => array('type' => 'int', 'constraint' => 11)
		), array('facebook_id'));
	}

	public static function notifications()
	{
		\DBUtil::create_table('facebook_notifications', array(
			'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
			'facebook_id' => array('type' => 'varchar', 'constraint' => 15),
			'template' => array('type' => 'varchar', 'constraint' => 200),
			'href' => array('type' => 'varchar', 'constraint' => 100),
			'sent_at' => array('type' => 'int', 'constraint' => 11, 'null' => true),
			'created_at' => array('type' => 'int', 'constraint' => 11),
			'updated_at' => array('type' => 'int', 'constraint' => 11)
		), array('id'));
	}
}
