Fuelbook
======

Example
------

```php
<?php

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 * 
 * @package  app
 * @extends  Controller
 */
class Controller_Welcome extends Controller_Template
{

	public function action_index()
	{
		if ( Fuelbook\Facebook::get_user() )
			$this->template->title = 'Faacebook Available';
		else
			$this->template->title = 'Faacebook Unavailable';

		$this->template->content = ViewModel::forge('home/index');
	}

	public function action_login()
	{
		// Redirect to facebook.
		return Request::forge('fuelbook/login')->execute();
	}
}
```

Method naming
------

SDK Methods named camelCase, but you can call methods named underscores to separate words, it's follow FuelPHP coding standard.

```
Facebook::getUser() -> Fuelbook\Facebook::get_user()

```