<?php

namespace App;
use \App    as App;
use \Nether as Nether;

class DataDocument
extends Nether\Object {
/*//
represents a parsed executive order from a datasource. this will be the api we
use to transition external data into our database.
//*/

	public static
	$PropertyMap = [
		'CitationID'    => 'CitationID',
		'DocumentID'    => 'DocumentID',
		'DocumentType'  => 'DocumentType',
		'SignedBy'      => 'SignedBy',
		'DatePublished' => 'DatePublished',
		'DateSigned'    => 'DateSigned',
		'Title'         => 'Title',
		'URLs'          => 'URLs'
	];

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	protected function
	__ready():
	Void {

		// for some reason trumps very first thing has no signing date
		// in the dataset so lets do some error handling as we find them.

		if(!$this->DatePublished && $this->DateSigned)
		$this->DatePublished = $this->DateSigned;

		if(!$this->DateSigned && $this->DatePublished)
		$this->DateSigned = $this->DatePublished;

		// enforce date format just in case one of the datasources uses
		// something odd.

		$this->DatePublished = date('Y-m-d',strtotime($this->DatePublished));
		$this->DateSigned = date('Y-m-d',strtotime($this->DateSigned));

		return;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	public function
	Store():
	App\Document {

		return App\Document::Create($this);
	}

}
