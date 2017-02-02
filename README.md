# Executive Order Archive

A little site to display how many orders per day Trump is signing without any
checks and balances.

Public Accessible Version: http://pda.opsat.net

None of the data sources I have found so far actually update daily, but it will
be good enough.

# Local Dev Setup

## Install dependencies.

This is handled by Composer. Here is an example if your composer in installed
system wide as it should be.

```
> composer install
```

## Configure Database Connection

Create an empty database in MySQL with access.

Create file `conf/database.conf.php` and copy paste the following example into
it, changing the Hostname, Username, Password, and Database, to values relevant
to your system. Leave everything else about this alone.

```php
<?php

Nether\Option::Set('nether-database-connections',[
	'Default' => [
		'Type'     => 'mysql',
		'Hostname' => 'server',
		'Username' => 'user',
		'Password' => 'pass',
		'Database' => 'dbname'
	]
]);
```

## Set Up Database

This is handled by Phinx, which was installed by Composer earlier. Run the
migrate command and all the tables will be setup in the database automagically.

```
> vendor\bin\phinx migrate
```

## Importing Data

You're gonna want data, too. This will hit the public government server to fetch
all of the available data it can that is relevant to this application. It will
also cache a copy of the data as they gave it to us in the `cache` directory.
PDF versions will also end up in the `archive` directory.

To get daily updates, you would want to set this up to cron.

```
> php bin\fetch-federal-register.php run
```

To get the historical data (which you will want, for the site to be useful) you
will have to import them president by president. It takes about 2hr per, as I
have it throttled so that the feds don't think you are cybering them.

```
> php bin\fetch-federal-register.php president clinton
> php bin\fetch-federal-register.php president bushjr
> php bin\fetch-federal-register.php president obama
> php bin\fetch-federal-register.php president trump
```

These are the presidents the Federal Register has exposed as something queryable
with their API, and it was more than enough to do its job for anyone with modern
memories.

## Test HTTP Server

If you are not not running this on a real server you can pop the PHP test server
up locally to test the app.

```
> php -S localhost:80 -t www
```

Then you just have to hit up `http://localhost` to test.
