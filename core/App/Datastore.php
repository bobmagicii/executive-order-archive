<?php

namespace App;
use \App    as App;
use \Nether as Nether;

class Datastore
extends Nether\Object\Datastore {

	protected
	$Total = NULL;

	public function
	Total():
	Int {
	/*//
	get the total number of items that could have been in this data set had
	there been no limitations in the search query. this value must be manually
	set else it will just return the current number of things in here. think
	of it as meta data for search results, because that is exactly how i am
	using it. named as it is to remain consistent with the api of the parent
	datastore.
	//*/

		if($this->Total !== NULL)
		return $this->Total;

		return $this->Count;
	}

	public function
	SetTotal(Int $Value):
	self {

		$this->Total = $Value;
		return $this;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	protected
	$Page = 1;

	public function
	Page():
	Int {

		return $this->Page;
	}

	public function
	SetPage(Int $Value):
	self {

		$this->Page = $Value;
		return $this;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	protected
	$Limit = 0;

	public function
	Limit():
	Int {

		return $this->Limit;
	}

	public function
	SetLimit(Int $Value):
	self {

		$this->Limit = $Value;
		return $this;
	}

}
