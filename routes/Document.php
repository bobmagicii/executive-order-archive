<?php

namespace Routes;
use \App    as App;
use \Nether as Nether;

class Document
extends App\Site\RoutePublicWeb {

	public function
	Index($CitationID):
	Void {

		$this->Surface->Set('Message',"Pull Document {$CitationID}");
		$this->Surface->Area('error/coming-soon');
		return;
	}

}