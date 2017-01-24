# Executive Order Archive

A little site to display how many orders per day Trump is signing without any
checks and balances.

None of the data sources I have found so far actually update daily, but it will
be good enough.

# Local Dev Setup

Install dependencies.

```
$ composer install
```

Create `conf/database.conf.php` to setup the details for the MySQL connection.
It is dangerous to go alone, take this. You need to know your server name,
your user name, your password, and the name of the database. Leave the rest as
I have it.

```php
<?php

Nether\Option::Set('nether-database-connections',[
	'Default' => [
		'Type'     => 'mysql',
		'Hostname' => 'ur-servername',
		'Username' => 'ur-username',
		'Password' => 'ur-password',
		'Database' => 'ur-db-name'
	]
]);
```

Start up the test server.

```
$ php -S localhost:80 -t www
```
