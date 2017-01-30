<?php

namespace App\Site\Element;
use \App    as App;
use \Nether as Nether;

class Pager
extends App\Site\Element {

	protected
	$Area = 'element/pager';

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	protected
	$Page = 1;

	public function
	GetPage():
	Int {

		return $this->Page;
	}

	public function
	SetPage(Int $Num):
	self {

		$this->Page = $Num;
		return $this;
	}

	////////
	////////

	protected
	$ItemPerPage = 1;

	public function
	GetItemPerPage():
	Int {

		return $this->ItemPerPage;
	}

	public function
	SetItemPerPage(Int $Num):
	self {

		$this->ItemPerPage = $Num;
		return $this;
	}

	////////
	////////

	protected
	$ItemCount = 0;

	public function
	GetItemCount():
	Int {

		return $this->ItemCount;
	}

	public function
	SetItemCount(Int $Count):
	self {

		$this->ItemCount = $Count;
		return $this;
	}

	////////
	////////

	protected
	$NextURL = NULL;

	public function
	GetNextURL():
	?String {

		return $this->NextURL;
	}

	public function
	SetNextURL(String $URL):
	self {

		$this->NextURL = $URL;
		return $this;
	}

	////////
	////////

	protected
	$PrevURL = NULL;

	public function
	GetPrevURL():
	?String {

		return $this->PrevURL;
	}

	public function
	SetPrevURL(String $URL):
	self {

		$this->PrevURL = $URL;
		return $this;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	public function
	GetPageCount():
	Int {
	/*//
	calculate how many pages there are to loop through given the data we have
	to work with.
	//*/

		return ceil($this->ItemCount / $this->ItemPerPage);
	}

	public function
	HasNextPage():
	Bool {
	/*//
	do we have more pages after this one available?
	//*/

		if($this->Page < $this->GetPageCount())
		return TRUE;

		return FALSE;
	}

	public function
	HasPrevPage():
	Bool {
	/*//
	do we have any pages before this one?
	//*/

		if($this->Page > 1)
		return TRUE;

		return FALSE;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	public static function
	NewFromDatastore(App\Datastore $Data):
	self {
	/*//
	oneshot a fully working version given one of our search result datastores
	with filled in metadata.
	//*/

		$Element = (new self)
		->SetPage($Data->Page())
		->SetItemCount($Data->Total())
		->SetItemPerPage($Data->Limit());

		return $Element;
	}

}
