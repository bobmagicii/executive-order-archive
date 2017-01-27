<?php

namespace Routes;
use \App    as App;
use \Routes as Routes;
use \Nether as Nether;

class Home
extends App\Site\RoutePublicWeb {

	public function
	Index():
	Void {

		$this->Surface->Area('home/chart-primary');
		$this->Surface->Area('home/orders-recent');
		return;
	}

	public function
	About():
	Void {

		echo "if you're here, you're all about the bass.";
		return;
	}

}
