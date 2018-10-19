<?php

return [
    'response_codes' => [
    	/* Own defined status codes */
    	'103' => 'Invalid authentication code',
        '104' => 'Some fields are missing or empty',
        '105' => ' already exists',
        '106' => 'Invalid details to get the data',
        '107' => 'Database query error',
        '108' => 'Verify the email to proceed further',
        '109' => 'Invalid file formats',

        /* Pre defined status codes */
        '200' => 'OK',
        '401' => 'Unauthorized access',
        '402' => 'Payment Required',
        '403' => 'Forbidden',
        '404' => 'Not Found',
        '500' => 'Internal Server Error'        
    ],
    'registration' =>['api_token'=>'wh@apikey@for@registration'],
    /* table names */
    'table' => [
    	'users'=>'users',
    	'user_details'=>'user_details',
    	'categories'=>'categories',
        'config_values'=>'config_values',
        'broadcasts'=>'broadcasts',
        'swaps'=>'swaps',
        'localvocals'=>'localvocals',
        'swaps_report'=>'swaps_report',
        'lv_like_share'=>'lv_like_share',
        'lv_comments'=>'lv_comments',
        'user_notifications'=>'user_notifications'
    ]	

];


?>