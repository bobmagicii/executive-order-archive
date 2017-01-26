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

	////////
	////////

	protected
	$Filename = NULL;

	public function
	GetFilename():
	String {

		return $this->Filename;
	}

	public function
	SetFilename(String $Filename):
	self {

		$this->Filename = $Filename;
		return $this;
	}

	////////
	////////

	protected
	$FromCache = FALSE;

	public function
	FromCache():
	Bool {

		return $this->FromCache;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	public function
	__construct() {

		$this->Items = new Nether\Object\Datastore;

		return;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	public function
	Query():
	Void {

		// fetch.
		$Raw = $this->Fetch();

		// decode.
		$Result = $this->Parse($Raw);

		// process.
		$Data = $this->Itemise($Result);

		// store.
		$this->GetItems()->SetData($Data);

		return;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	protected function
	Fetch():
	String {
	/*//
	@date 2017-01-25
	perform the http request and return the raw data that resulted from it.
	//*/

		$Raw = $this->Fetch_FromCache();

		if($Raw) {
			$this->FromCache = true;
			return $Raw;
		}

		////////

		$Raw = $this->Fetch_FromRemote();
		$this->Cache($Raw);

		return $Raw;
	}

	protected function
	Fetch_FromCache():
	?String {

		if($this->Filename)
		if(file_exists($this->Filename))
		if(is_readable($this->Filename))
		return file_get_contents($this->Filename);

		return NULL;
	}

	protected function
	Fetch_FromRemote():
	?String {

		$Bit = new Nether\Input\Filter(parse_url($this->URL));
		$Raw = file_get_contents($this->URL);

		if($Raw === FALSE)
		throw new Exception("error contacting {$Bit->Host}");

		return $Raw;
	}

	protected function
	Cache(String $Raw):
	Void {

		if($this->Filename)
		file_put_contents($this->Filename,$Raw);

		return;
	}

	protected abstract function
	Parse(String $Raw);
	/*//
	@date 2017-01-25
	just parse whatever format the data came in and return whatever that
	directly translates to as a language structure.
	//*/

	protected abstract function
	Itemise($Data):
	Array;
	/*//
	@date 2017-01-25
	this method should go through the parsed data and populate a dataset
	with DataOrder objects.
	//*/

}
