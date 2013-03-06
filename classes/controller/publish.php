<?php

namespace Fuelbook;

class Controller_Publish extends Controller {

	public function action_status($args)
	{
		if ( ! \Request::is_hmvc() and \Config::get('fuelbook.only_hmvc'))
		{
			throw new HttpNotFoundException();
		}

		try
		{
			Facebook::api('/me/feed', 'POST', array('message' => $args['message']));
		}
		catch (\FacebookApiException $e)
		{
			\Log::error($e->getMessage());
		}
	}
}