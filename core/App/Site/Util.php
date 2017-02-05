<?php

namespace App\Site;
use \App    as App;
use \Nether as Nether;

class Util {

	public static function
	GetFetchDate():
	String {

		$Filename = Nether\Option::Get('app-fetch-timefile');

		if(!is_readable($Filename))
		return 'Unknown';

		////////

		$Time = (Int)trim(file_get_contents($Filename));

		if(!$Time)
		return 'Unknown';

		////////

		return date('Y-m-d g:ia T',$Time);
	}

}
