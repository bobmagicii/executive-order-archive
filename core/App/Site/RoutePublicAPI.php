<?php

namespace App\Site;
use \App    as App;
use \Nether as Nether;

class RoutePublicAPI
extends App\RoutePublicWeb {

	public function
	__construct() {
		parent::__construct();

		$this->Surface
		->SetTheme('json');

		return;
	}

}
