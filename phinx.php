<?php

// ninja a database configuration for phinx from the application like a baus.

require(sprintf(
	'%s/conf/start.php',
	dirname(__FILE__)
));

return [
	'environments' => [
		'default_database' => 'default',
		'default' => [
			'name' => 'app',
			'connection' => (new Nether\Database)->GetDriver()
		]
	],
	'templates' => [
		'file' => '%%PHINX_CONFIG_DIR%%/phinx/Template.txt'
	],
	'paths' => [
		'migrations' => '%%PHINX_CONFIG_DIR%%/phinx'
	]
];




