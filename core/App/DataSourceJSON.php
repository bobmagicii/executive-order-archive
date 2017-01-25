<?php

namespace App;
use \App    as App;
use \Nether as Nether;

abstract class DataSourceJSON
extends App\DataSource {
/*//
provide JSON decoding ability to a datasource.
//*/

	protected function
	Parse(String $Raw) {
	/*//
	@date 2017-01-25
	parse what we expected to be a json object from the request.
	//*/

		$Bit = new Nether\Input\Filter(parse_url($this->URL));
		$Data = json_decode($Raw);
		$Output = NULL;

		////////

		if(!$Data || !is_object($Data))
		throw new Exception("error parsing json from {$Bit->Host}");

		return $Data;
	}

}
