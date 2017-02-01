<?php

namespace App\DataSources;
use \App    as App;
use \Nether as Nether;

class FederalRegister
extends App\DataSourceJSON {
/*//
@date 2017-01-25
fetch data from the federal register. the query was generated using their api
tool: https://www.federalregister.gov/developers/api/v1/
//*/

	protected
	$URL = 'https://www.federalregister.gov/api/v1/documents.json'.
	'?fields%5B%5D=body_html_url'.
	'&fields%5B%5D=citation'.
	'&fields%5B%5D=document_number'.
	'&fields%5B%5D=executive_order_number'.
	'&fields%5B%5D=full_text_xml_url'.
	'&fields%5B%5D=html_url'.
	'&fields%5B%5D=json_url'.
	'&fields%5B%5D=pdf_url'.
	'&fields%5B%5D=president'.
	'&fields%5B%5D=publication_date'.
	'&fields%5B%5D=raw_text_url'.
	'&fields%5B%5D=signing_date'.
	'&fields%5B%5D=subtype'.
	'&fields%5B%5D=title'.
	'&fields%5B%5D=type'.
	'&per_page=75'.
	'&order=newest'.
	'&conditions%5Bpresidential_document_type%5D%5B%5D=determination'.
	'&conditions%5Bpresidential_document_type%5D%5B%5D=executive_order'.
	'&conditions%5Bpresidential_document_type%5D%5B%5D=memorandum'.
	'&conditions%5Bpresidential_document_type%5D%5B%5D=notice'.
	'&conditions%5Bpresidential_document_type%5D%5B%5D=proclamation'.
	'&conditions%5Bpresidential_document_type%5D%5B%5D=presidential_order';

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	public function
	GetCacheFile():
	?String {
	/*//
	@override
	//*/

		return sprintf(
			'%s%sFederalRegister-%s.txt',
			CacheRoot,
			DIRECTORY_SEPARATOR,
			date('Ymd')
		);
	}

	public function
	GetArchiveDir():
	?String {
	/*//
	@override
	//*/

		return sprintf(
			'%s%sFederalRegister',
			ArchiveRoot,
			DIRECTORY_SEPARATOR
		);
	}

	protected function
	Itemise($Data):
	Array {
	/*//
	@override
	//*/

		// dropping a formatted version in the cache dir so i can inspect.

		$Filename = preg_replace(
			'/\.txt$/', '.json',
			$this->GetCacheFile()
		);

		file_put_contents($Filename,json_encode($Data,JSON_PRETTY_PRINT));

		////////

		$Output = [];

		foreach($Data->results as $Result) {
			$Output[] = new App\DataDocument([
				'CitationID'    => $Result->citation,
				'DocumentID'    => $Result->document_number,
				'DocumentType'  => $Result->subtype,
				'SignedBy'      => $Result->president->identifier,
				'DatePublished' => $Result->publication_date,
				'DateSigned'    => $Result->signing_date,
				'Title'         => $Result->title,
				'URLs'          => [
					'Federal Register PDF'  => $Result->pdf_url
				]
			]);
		}

		return $Output;
	}

}
