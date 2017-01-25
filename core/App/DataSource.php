<?php

namespace App;
use \App    as App;
use \Nether as Nether;

abstract class
DataSource {

	protected
	$URL = '';

	public function
	GetURL():
	String {

		return $this->URL;
	}

	////////
	////////

	protected
	$Items = NULL;

	public function
	GetItems():
	Nether\Object\Datastore {

		return $this->Items;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	public function
	__construct() {

		$this->Items = new Nether\Object\Datastore;

		// get our cake.
		$Result = $this->Parse($this->Fetch());

		// eat our cake.
		$this->Items->SetData($this->Itemise($Result));

		return;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	public function
	Fetch():
	String {
	/*//
	@date 2017-01-25
	perform the http request and return the raw data that resulted from it.
	//*/

		$Bit = new Nether\Input\Filter(parse_url($this->URL));
		$Raw = file_get_contents($this->URL);

		if($Raw === FALSE)
		throw new Exception("error contacting {$Bit->Host}");

		return $Raw;
	}

	abstract protected function
	Parse(String $Raw);
	/*//
	@date 2017-01-25
	just parse whatever format the data came in and return whatever that
	directly translates to as a language structure.
	//*/

	abstract protected function
	Itemise($Data):
	Array;
	/*//
	@date 2017-01-25
	this method should go through the parsed data and populate a dataset
	with DataOrder objects.
	//*/

}
