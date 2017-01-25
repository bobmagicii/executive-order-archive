#!/usr/bin/env php
<?php

require(sprintf(
	'%s/conf/start.php',
	dirname(__FILE__,2)
));

$CLI = new class
extends Nether\Console\Client {

	protected function
	HandleHelp():
	Int {

		$this::Messages(
			'',
			'USAGE: eoa-fetch-federal-register run',
			'',
			'Fetches the data from the federal register for today and caches it to disk. Prints JSON about the result.',
			''
		);

		return 0;
	}

	protected function
	HandleRun():
	Int {

		$Output = [
			'Error'    => 0,
			'Message'  => 0,
			'Filename' => NULL
		];

		$Filename = sprintf(
			'%s/federalregister-%s.json',
			CacheRoot,
			Date('Ymd')
		);

		$Source = new App\DataSources\FederalRegister;

		echo json_encode($Output,JSON_PRETTY_PRINT);
		return 0;
	}

};

$CLI->Run();
