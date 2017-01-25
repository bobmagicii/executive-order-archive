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
	'?fields%5B%5D=abstract'.
	'&fields%5B%5D=action'.
	'&fields%5B%5D=body_html_url'.
	'&fields%5B%5D=dates'.
	'&fields%5B%5D=document_number'.
	'&fields%5B%5D=executive_order_notes'.
	'&fields%5B%5D=executive_order_number'.
	'&fields%5B%5D=full_text_xml_url'.
	'&fields%5B%5D=html_url'.
	'&fields%5B%5D=json_url'.
	'&fields%5B%5D=pdf_url'.
	'&fields%5B%5D=president'.
	'&fields%5B%5D=publication_date'.
	'&fields%5B%5D=raw_text_url'.
	'&fields%5B%5D=significant'.
	'&fields%5B%5D=signing_date'.
	'&fields%5B%5D=subtype'.
	'&fields%5B%5D=title'.
	'&fields%5B%5D=type'.
	'&per_page=100'.
	'&page=1'.
	'&order=newest'.
	'&conditions%5Btype%5D%5B%5D=PRESDOCU'.
	'&conditions%5Bpresidential_document_type%5D%5B%5D=executive_order'.
	'&conditions%5Bpresidential_document_type%5D%5B%5D=proclamation'.
	'&conditions%5Bpresidential_document_type%5D%5B%5D=presidential_order';

	protected function
	Itemise($Data):
	Array {

		$Output = [];

		return $Output;
	}

}
