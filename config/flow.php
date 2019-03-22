<?php

// FlowCP configuration file

return [
	// Server hostname and ports
    'servers' => [
        'login' => [
            'hostname' => 'localhost',
            'port' => 6900,
        ],
        'char' => [
            'hostname' => 'localhost',
            'port' => 6121,
        ],
        'map' => [
            'hostname' => 'localhost',
            'port' => 5121,
        ],
    ],

	// Server name
	'server_name' => 'FlowRO',

	// How long should Flow cache server statuses?
    'server_status_cache_time' => 1,

	// Site Title
	'title' => 'Flow Control Panel',

	// Password hashing algorithm
    // Available: MD5, BCRYPT, NONE
    'password_algo' => 'NONE',

	// Password minimum length
	'password_min_length' => 8,

	// Verify email of newly registered users? [Not yet implemented]
	'verify_email' => false,

	// Enable reCAPTCHA? [Not yet implemented]
	'enable_recaptcha' => false,
];