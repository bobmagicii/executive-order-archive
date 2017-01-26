<?php

// ninja a database configuration for phinx from the application like a baus.

require(sprintf(
	'%s/conf/start.php',
	dirname(__FILE__)
));

$Connection = (new Nether\Database)->GetDriver();
$Database = Nether\Option::Get('nether-database-connections')['Default']['Database'];

return [
	'environments' => [
		'default_database' => 'default',
		'default' => [
			'name' => $Database,
			'connection' => $Connection
		]
	],
	'templates' => [
		'file' => '%%PHINX_CONFIG_DIR%%/phinx/Template.txt'
	],
	'paths' => [
		'migrations' => '%%PHINX_CONFIG_DIR%%/phinx'
	]
];




