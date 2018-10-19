<?php

return [

	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => '\\OAuth\\Common\\Storage\\Session',

	/**
	 * Consumers
	 */
	'consumers' => [

		'Facebook' => [
			'client_id'     => '1161672633923030',
			'client_secret' => 'c95919d6c9b95294b4fcf90f57728c46',
			'scope'         => ['email','read_friendlists','user_online_presence'],
		],
		
		
		'Google' => [
			'client_id'     => '431787600078-7g4skhqo2f6ll318c43vumoehgh4m8in.apps.googleusercontent.com',
			'client_secret' => 'BlmdlI0KIpHpyhzdX941fGQX',
			'scope'         => ['userinfo_email', 'userinfo_profile'],
		],

	]

];