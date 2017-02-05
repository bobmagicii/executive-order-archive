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
			'USAGE: fetch-federal-register <cmd>',
			'',
			'run <options>',
			'',
			'    Fetches the most recent documents. Consider using this for a daily cron.',
			'',
			'    --skip-archive',
			'',
			'      Do not download the documents locally. Just populate the database.',
			'',
			'    --skip-cache',
			'',
			'      Do not cache the raw request locally.',
			'',
			'president <who> <options>',
			'',
			'    Fetch the entire presidential document history for the specified president. Currently valid choices:',
			'',
			'    clinton, bushjr, obama, trump',
			'',
			'    --skip-archive',
			'',
			'      Do not download the documents locally. Just populate the database.',
			'',
			'    --skip-cache',
			'',
			'      Do not cache the raw request locally.',
			''
		);

		return 0;
	}

	protected function
	HandlePresident():
	Int {

		$Document = NULL;
		$DataDocument = NULL;
		$Source = NULL;

		switch($this->GetInput(2)) {
			case 'william-j-clinton':
			case 'clinton': {
				$Source = new App\DataSources\FederalRegister\BillClinton;
				break;
			}
			case 'george-w-bush':
			case 'bushjr': {
				$Source = new App\DataSources\FederalRegister\GeorgeBushJr;
				break;
			}
			case 'barack-obama':
			case 'obama': {
				$Source = new App\DataSources\FederalRegister\BarackObama;
				break;
			}
			case 'donald-trump':
			case 'trump': {
				$Source = new App\DataSources\FederalRegister\DonaldTrump;
				break;
			}
			default: {
				$this::Messages(
					'',
					'no valid president found.',
					' - clinton or william-j-clinton',
					' - bushjr or george-w-bush',
					' - obama or barack-obama',
					' - trump or donald-trump',
					''
				);
				return 0;
			}
		}


		$Source->Query();

		////////

		if(!$this->GetOption('skip-cache') && $Source->FromCache())
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

	protected function
	HandleRun():
	Int {

		$Document = NULL;
		$DataDocument = NULL;
		$Source = new App\DataSources\FederalRegister;

		$Source->Query();

		////////

		if(!$this->GetOption('skip-cache') && $Source->FromCache())
		$this::Message('Data loaded from cache.');

		else
		$this::Message('Data downloaded from remote.');

		////////

		foreach($Source->GetItems() as $DataDocument) {
			$Document = $DataDocument->Store();

			if(!$this->GetOption('skip-archive'))
			$Document->Archive($Source->GetArchiveDir());
		}

		$this->UpdateTimeFile();
		return 0;
	}

	private function
	UpdateTimeFile():
	Void {

		$Filename = Nether\Option::Get('app-fetch-timefile');
		$Dirname = dirname($Filename);

		if(!file_exists($Dirname))
		@mkdir($Dirname,0777,TRUE);

		if(!is_dir($Dirname)) {
			$this::Message("Unable to update time file {$Filename}");
			return;
		}

		file_put_contents($Filename,time());
		return;
	}

};

$CLI->Run();
