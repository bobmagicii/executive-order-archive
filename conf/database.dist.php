<?php

// fill in the appropriate values for your database connection and then rename
// this file to database.conf.php.

// note mysql is the only database supported right now. if you are setting this
// up for the first them then you should run phinx migrate to setup the tables.

Nether\Option::Set('nether-database-connections',[
	'Default' => [
		'Type'     => 'mysql',
		'Hostname' => 'your-server-hostname',
		'Username' => 'your-database-username',
		'Password' => 'your-database-password',
		'Database' => 'your-database-name'
	]
]);
