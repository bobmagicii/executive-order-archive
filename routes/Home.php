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

		$this->Surface->Set('RecentDocuments',App\Document::Search([
			'Sort' => 'newest'
		]));

		$this->Surface->Area('home/chart-primary');
		$this->Surface->Area('home/orders-recent');
		return;
	}

}
