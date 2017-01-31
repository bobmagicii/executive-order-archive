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
			'USAGE: fetch-federal-register run',
			'',
			'Fetches the data from the federal register for today.',
			''
		);

		return 0;
	}

	protected function
	HandleRun():
	Int {

		$Document = NULL;
		$DataDocument = NULL;
		$Source = new App\DataSources\FederalRegister;

		$Source->Query();

		////////

		if($Source->FromCache())
		$this::Message('Data loaded from cache.');

		else
		$this::Message('Data downloaded from remote.');

		////////

		foreach($Source->GetItems() as $DataDocument) {
			$Document = $DataDocument->Store();

			if(!$this->GetOption('skip-archive'))
			$Document->Archive($Source->GetArchiveDir());
		}

		return 0;
	}

};

$CLI->Run();
