<?php

Nether\Option::Set([
	'app-name'        => 'App',
	'app-short-desc'  => 'A list and some stats about presidential orders.',
	'app-long-desc'   => 'A list and some stats about presidential orders.',
	'nether-web-root' => WebRoot,
	'nether-web-path' => '/'
]);

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

// i have my reasons.

ini_set('user_agent',sprintf(
	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) '.
	'AppleWebKit/%d.%d (KHTML, like Gecko) '.
	'Chrome/%d.%d.%d.%d Safari/%1$d.%2$d',
	random_int(400,550),
	random_int(1,99),
	random_int(40,55),
	random_int(1,9),
	random_int(1000,2500),
	random_int(1,99)
));
