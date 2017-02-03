<?php

namespace App\Site;
use \App    as App;
use \Nether as Nether;

class Filters {
/*//
these methods are designed to be passed to the handlers for Nether\Input\Filter
input handling for common types of user input we need to check and sanitize
before attempting to use.
//*/

	public static function
	PageNumber($Val):
	Int {
	/*//
	reasonable page numbers have to be legit numbers greater than or equal to
	one. anything not valid gets turned into 1.
	//*/

		if(!is_numeric($Val) || $Val < 1)
		return 1;

		return (Int)$Val;
	}

	public static function
	DocumentID($Val):
	String {
	/*//
	document and citation id input is subject to extreme vetting.
	//*/

		return preg_replace(
			'/[^a-z0-9-]+/', '',
			strtolower($Val)
		);
	}

	public static function
	DomainFromURL(String $URL):
	String {

		$Domain = parse_url($URL,PHP_URL_HOST);

		if(!$Domain)
		return 'Error Parsing URL.';

		return $Domain;
	}

}
