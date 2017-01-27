<?php

namespace Routes;
use \App    as App;
use \Routes as Routes;
use \Nether as Nether;

class About
extends App\Site\RoutePublicWeb {

	public function
	Index():
	Void {

		$this->Surface->Area('about/index');
		return;
	}

}
