<?php

namespace Fuelbook;

abstract class Model_Graph extends \Model
{
	protected static $_graph_path = '';
	protected static $_properties = array(
		'id' => array()
	);
	protected static $_data_path = '';

	private $value = array();

	public static function find(/* polymorphic */)
	{
		$args = func_get_args();

		if ( count($args) <= 1 )
		{
			return static::get_by_primary( isset($args[0]) ? $args[0] : null );
		}
	}

	protected static function get_by_primary( $value = null )
	{
		$result = Facebook::api( sprintf(static::$_graph_path, (string) $value));

		$key_path = explode('/', static::$_data_path);

		foreach ( $key_path as $path ) {
			if ( ! $path ) continue;
			$result = $result[$path];
		}

		return static::fetch($result);
	}

	public static function fetch($value = null)
	{
		$instance = new static();

		$value = (array) $value;

		foreach ( static::$_properties as $property_id => $property )
		{
			if ( is_int($property_id) ) {
				$property_id = $property;
				$property = array();
			}

			$path = array($property_id);

			if ( isset($property['path']) ) {
				$path = explode('/', $property['path']);
			}

			$real_value = $value;

			foreach ($path as $id) {
				if ( isset($real_value[$id]) ) $real_value = $real_value[$id];
			}

			if ( empty($real_value) and isset($property['default']) ) $real_value = $property['default'];

			if ( isset( $value[$property_id] ))
				$instance->set($property_id, $real_value);
		}

		return $instance;
	}

	public function set($name, $value)
	{
		if ( array_key_exists($name, static::$_properties) or in_array($name, static::$_properties) ) {
			$this->value[$name] = $value;
			return;
		}

		throw new \Exception('Invaid property name.');
	}

	public function __get($name)
	{
		if ( isset($this->value[$name]) ) {
			return $this->value[$name];
		}

		if ( array_key_exists($name, static::$_properties) or in_array($name, static::$_properties)) {
			return null;
		}

		throw new \Exception('Invaid property name.');
	}
}