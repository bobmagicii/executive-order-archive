<?php

namespace App\Site;
use \App    as App;
use \Nether as Nether;

class Router
extends Nether\Avenue\Router {

	public function
	__construct($Opt=NULL) {
		parent::__construct($Opt);

		$this
		->AddRoute('{@}//index','Routes\Home::Index')
		->AddRoute('{@}//about','Routes\Home::About');

		return;
	}

}
