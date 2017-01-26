<?php

namespace Routes\ApiWeb1;
use \App    as App;
use \Nether as Nether;
use \Routes as Routes;

class Test
extends App\Site\RoutePublicAPI {

	public function
	Index():
	Void {
	/*//
	silly test route to test features of the api api.
	//*/

		$this
		->SetError(42)
		->SetMessage('Don\'t Panic')
		->SetLocation('https://milkyway.galaxy/earth')
		->SetPayload([
			'Day' => 'Thursday'
		])
		->SetPayload([
			'Colour' => 'Yellow'
		]);

		return;
	}

}
