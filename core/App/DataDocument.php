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

}
