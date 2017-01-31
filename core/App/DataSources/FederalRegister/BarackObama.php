<?php

namespace App\DataSources\FederalRegister;
use \App    as App;
use \Nether as Nether;

class BarackObama
extends App\DataSources\FederalRegister\PresidentHistory {
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
	'&per_page=100'.
	'&page=1'.
	'&order=oldest'.
	'&conditions%5Bpresidential_document_type%5D%5B%5D=determination'.
	'&conditions%5Bpresidential_document_type%5D%5B%5D=executive_order'.
	'&conditions%5Bpresidential_document_type%5D%5B%5D=memorandum'.
	'&conditions%5Bpresidential_document_type%5D%5B%5D=notice'.
	'&conditions%5Bpresidential_document_type%5D%5B%5D=proclamation'.
	'&conditions%5Bpresidential_document_type%5D%5B%5D=presidential_order'.
	'&conditions%5Bpresident%5D%5B%5D=barack-obama';

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	public function
	GetCacheFile():
	String {
	/*//
	@override
	//*/

		return sprintf(
			'%s%sFederalRegister-BarackObama-%s-%d.txt',
			CacheRoot,
			DIRECTORY_SEPARATOR,
			date('Ymd'),
			$this->Page
		);
	}

	public function
	GetArchiveDir():
	?String {
	/*//
	@override
	//*/

		return sprintf(
			'%s%sFederalRegister%sBarackObama',
			ArchiveRoot,
			DIRECTORY_SEPARATOR,
			DIRECTORY_SEPARATOR
		);
	}

}
