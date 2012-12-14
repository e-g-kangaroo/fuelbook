<?php

namespace Fuelbook;

class Controller_Notification extends Controller
{
	public function action_send()
	{
		$notifications = Model_Facebook_Notification::find('all', array(
			'where' => array('sent_at' => null),
			'limit' => 30
		));

		foreach ($notifications as $notice)
		{
			$ch = curl_init("https://graph.facebook.com/{$notice->facebook_id}/notifications");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data = array(
				'access_token' => \Config::get('fuelbook.app_id').'|'.\Config::get('fuelbook.app_secret'),
				'template' => $notice->template,
				'href' => $notice->href
			));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($ch);
			curl_close($ch);

			$output_json = json_decode($output);

			if ( isset($output_json->success) and $output_json->success == true )
			{
				$notice->sent_at = time();
				$notice->save();
			}
			else
			{
				\Log::error('Notification error: '.$output_json->error->message);
			}
		}

		if ( ! \Request::is_hmvc()) {
			\Response::redirect('/');
		}
	}
}