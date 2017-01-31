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

	// public api.

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

	// internal api.

	protected function
	Cache(String $Raw):
	Void {
	/*//
	used to store the draw data we got from the remote datasource locally.
	to be honest this is mostly so i can test over and over without having
	to hit a government server 300 times today and causing fbi show up at my
	office on the federal sources.
	//*/

		$Filename = $this->GetCacheFile();

		////////

		if($Filename)
		file_put_contents($Filename,$Raw);

		return;
	}

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
	/*//
	@date 2017-01-25
	concerns for fetching from a cached file.
	//*/

		$Filename = $this->GetCacheFile();

		if($Filename)
		if(file_exists($Filename) && is_readable($Filename))
		return file_get_contents($Filename);

		return NULL;
	}

	protected function
	Fetch_FromRemote():
	?String {
	/*//
	@date 2017-01-25
	concerns for fetching from the remote datasource.
	//*/

		$Bit = new Nether\Input\Filter(parse_url($this->URL));
		$Raw = file_get_contents($this->URL);

		if($Raw === FALSE)
		throw new Exception("error contacting {$Bit->Host}");

		return $Raw;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	// abstracts and other methods designed to be overridden.

	public function
	GetCacheFile():
	?String {
	/*//
	@date 2017-01-26
	return the filename used to store a copy of the data locally. we do this
	as a method so it can magic dynamic itself without having to do silly
	things within a constructor for a property. this default implementation
	disables cache.
	//*/

		return NULL;
	}

	public function
	GetArchiveDir():
	?String {
	/*//
	@date 2017-01-31
	return the directory path used to store copies of all the urls that this
	document had for the document. this default implmentation disables the
	archive process.
	//*/

		return NULL;
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
