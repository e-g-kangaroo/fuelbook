Fuelbook
======

Fuelbook is Facebook module for FuelPHP.

Install
------

```
APPPATH=fuel/app
git clone git@github.com:niaeashes/fuelbook.git $APPPATH/modules/fuelbook
git clone git://github.com/facebook/facebook-php-sdk.git $APPPATH/vendor/facebook
cp $APPPATH/modules/fuelbook/config/fuelbook.php $APPPATH/config/fuelbook.php
```

Example
------

```php
<?php

class Controller_Welcome extends Controller_Template
{

	public function action_index()
	{
		if ( Fuelbook\Controller::facebook_id() )
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