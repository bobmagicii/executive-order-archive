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

		echo "if you're here, you're home.";
		return;
	}

	public function
	About():
	Void {

		echo "if you're here, you're all about the bass.";
		return;
	}

}
