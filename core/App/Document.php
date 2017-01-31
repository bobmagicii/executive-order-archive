<?php

namespace App;
use \App    as App;
use \Nether as Nether;

use \Exception as Exception;

class Document
extends Nether\Object {
/*//
represents an executive document in our database.
//*/

	public static
	$PropertyMap = [
		'doc_id'             => 'ID:int',
		'doc_citation_id'    => 'CitationID',
		'doc_document_id'    => 'DocumentID',
		'doc_document_type'  => 'DocumentType',
		'doc_signed_by'      => 'SignedBy',
		'doc_date_published' => 'DatePublished',
		'doc_date_signed'    => 'DateSigned',
		'doc_title'          => 'Title',
		'doc_json_urls'      => 'JsonDataURLs'
	];

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	protected
	$ID = '';

	public function
	GetID():
	Int {

		return $this->ID;
	}

	////////
	////////

	protected
	$CitationID = '';

	public function
	GetCitationID():
	String {

		return $this->CitationID;
	}

	public function
	GetCitationKey():
	String {

		return str_replace(
			' ','-',
			strtolower($this->CitationID)
		);
	}

	////////
	////////

	protected
	$DocumentID = '';

	public function
	GetDocumentID():
	String {

		return $this->DocumentID;
	}

	public function
	GetDocumentKey():
	String {

		return str_replace(
			' ','-',
			strtolower($this->DocumentID)
		);
	}

	////////
	////////

	protected
	$DocumentType = '';

	public function
	GetDocumentType():
	String {

		return $this->DocumentType;
	}

	////////
	////////

	public function
	GetSignedBy():
	String {

		return $this->SignedBy;
	}

	////////
	////////

	protected
	$Title = '';

	public function
	GetTitle():
	String {

		return $this->Title;
	}

	////////
	////////

	protected
	$DatePublished = '';

	public function
	GetDatePublished():
	String {

		return $this->DatePublished;
	}

	////////
	////////

	protected
	$DateSigned = '';

	public function
	GetDateSigned():
	String {

		return $this->DateSigned;
	}

	////////
	////////

	protected
	$URLs = NULL;

	public function
	GetURLs():
	Array {

		return $this->URLs;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	public function
	__ready():
	Void {

		$this->URLs = json_decode($this->JsonDataURLs,TRUE);

		if(!is_array($this->URLs))
		$this->URLs = [];

		return;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	public function
	Archive(String $Path):
	self {
	/*//
	@date 2017-01-31
	since trump is signing the "cyber" order today we better provide a means
	to archive this shit locally.
	//*/

		$Filename = NULL;
		$Filetype = 'txt';
		$IsCLI = (php_sapi_name() === 'cli');

		////////

		if(!file_exists($Path)) {
			@mkdir($Path,0777,TRUE);

			if(!file_exists($Path))
			throw new Exception('Unable to create archive directory.');
		}

		if(!is_writable($Path))
		throw new Exception('Archive directory not writable.');

		///////

		foreach($this->GetURLs() as $Label => $URL) {
			$Filetype = strtolower(trim(preg_replace(
				'/^(.+) ([a-z0-9]{1,4})$/i','$2',
				$Label
			)));

			// if you are here debugging this exception then chanced are
			// you probably made the source class bad. the url keys should
			// have the same format as the others, something like
			// "Place It Came From TYPE" e.g. "Federal Register HTML" so
			// that we can determine .html for the file.

			if(!$Filetype || mb_strlen($Filetype) > 4)
			throw new Exception('It looks like the file extension code failed to match properly.');

			$Filename = sprintf(
				'%s%s%s.%s',
				$Path,
				DIRECTORY_SEPARATOR,
				$this->GetDocumentKey(),
				$Filetype
			);

			if(file_exists($Filename) && filesize($Filename) > 0) {
				if($IsCLI) printf(
					'Already Have %s%s',
					basename($Filename),
					PHP_EOL
				);

				continue;
			}

			if($IsCLI) printf(
				'Archiving %s: %s%s',
				$Label,
				basename($Filename),
				PHP_EOL
			);

			file_put_contents($Filename,file_get_contents($URL));
			sleep(1);
		}

		return $this;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	public static function
	Get(Int $ID):
	?self {

		$SQL = Nether\Database::Get()->NewVerse();
		$Result = NULL;

		////////

		$Result = $SQL
		->Select('Documents')
		->Fields('*')
		->Where('doc_id=:ID')
		->Limit(1)
		->Query([
			'ID' => $ID
		]);

		////////

		if(!$Result->IsOK())
		throw new Exception('Document::Get() critical failure.');

		if(!$Result->GetCount())
		return NULL;

		////////

		return new self($Result->Next());
	}

	public static function
	GetByCitationID(String $CitationID):
	?self {

		$SQL = Nether\Database::Get()->NewVerse();
		$Result = NULL;

		////////

		$Result = $SQL
		->Select('Documents')
		->Fields('*')
		->Where('doc_citation_id=:CitationID')
		->Limit(1)
		->Query([
			'CitationID' => $CitationID
		]);

		////////

		if(!$Result->IsOK())
		throw new Exception('Document::GetByCitationID() critical failure.');

		if(!$Result->GetCount())
		return NULL;

		////////

		return new self($Result->Next());
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	public static function
	Search($Opt=NULL):
	App\Datastore {
	/*//
	perform a search for documents.
	//*/

		$Output = new App\Datastore;
		$SQL = (new Nether\Database)->NewVerse();

		////////

		// group, validate, and generate options.

		$Opt = new Nether\Object($Opt,[
			'Sort'             => 'newest',
			'Limit'            => 10,
			'Page'             => 1,
			'PublishDateStart' => NULL,
			'PublishDateEnd'   => NULL,
			'SignedBy'         => NULL
		]);

		if(!is_numeric($Opt->Page) || $Opt->Page < 1)
		$Opt->Page = 1;

		$Opt->Offset = ($Opt->Page - 1) * $Opt->Limit;

		////////

		// base query.

		$SQL
		->Select('Documents')
		->Fields('SQL_CALC_FOUND_ROWS *');

		if($Opt->Limit) $SQL
		->Offset($Opt->Offset)
		->Limit($Opt->Limit);

		////////

		// apply filters.

		if($Opt->PublishDateStart && $Opt->PublishDateEnd) $SQL
		->Where('doc_date_published BETWEEN CAST(:PublishDateStart AS DATE) AND CAST(:PublishDateEnd AS DATE)');

		if($Opt->SignedBy) $SQL
		->Where('doc_signed_by LIKE :SignedBy');

		////////

		// apply sortings.

		switch($Opt->Sort) {
			case 'newest':
			$SQL->Sort('doc_date_published',$SQL::SortDesc);
			break;

			case 'oldest':
			$SQL->Sort('doc_date_published',$SQL::SortAsc);
			break;
		}

		////////

		$Result = $SQL->Query($Opt);

		$Found = $SQL->GetDatabase()
		->Query('SELECT FOUND_ROWS() AS FoundRows')
		->Next()
		->FoundRows;

		if(!$Result->IsOK())
		throw new Exception('Document::Search() critical failure');

		while($Row = $Result->Next())
		$Output->Push(new static($Row));

		$Output
		->SetTotal($Found)
		->SetPage($Opt->Page)
		->SetLimit($Opt->Limit);

		return $Output;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	public static function
	Create($Opt=NULL):
	self {
	/*//
	create a new document in the database. if one with the same citation
	number already exists then it will return the existing one silently
	rather than create a duplicate.
	//*/

		$Old = NULL;
		$SQL = NULL;
		$Result = NULL;
		$ID = NULL;

		////////

		$Opt = new Nether\Object($Opt,[
			'CitationID'    => NULL,
			'DocumentID'    => NULL,
			'DocumentType'  => NULL,
			'SignedBy'      => NULL,
			'DatePublished' => NULL,
			'DateSigned'    => NULL,
			'Title'         => NULL,
			'URLs'          => []
		]);

		if(!$Opt->CitationID)
		throw new Exception('Documents must have a CitationID');

		if(!is_array($Opt->URLs))
		throw new Exception('URLs must be an array.');

		////////

		$Opt->JsonDataURLs = json_encode($Opt->URLs);

		////////

		// see if we already have this document.
		// @todo - if found, check urls array to make sure we didnt just
		// add new ones to the document. moar sauces!

		$Old = self::GetByCitationID($Opt->CitationID);
		if($Old) return $Old;

		////////

		$SQL = Nether\Database::Get()->NewVerse();

		$Result = $SQL
		->Insert('Documents')
		->Values([
			'doc_citation_id'    => ':CitationID',
			'doc_document_id'    => ':DocumentID',
			'doc_document_type'  => ':DocumentType',
			'doc_signed_by'      => ':SignedBy',
			'doc_date_published' => ':DatePublished',
			'doc_date_signed'    => ':DateSigned',
			'doc_title'          => ':Title',
			'doc_json_urls'      => ':JsonDataURLs'
		])
		->Query($Opt);

		if(!$Result->IsOK())
		throw new Exception('Document::Create critical failure');

		$ID = $Result->GetInsertID();

		if(!$ID)
		throw new Exception('Document::Create weird failure');

		////////

		return static::Get((Int)$ID);
	}

}
