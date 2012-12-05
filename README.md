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
		if ( Request::forge('fuelbook/status')->execute() )
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