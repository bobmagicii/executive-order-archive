<?php

namespace Routes;
use \App    as App;
use \Nether as Nether;

class Document
extends App\Site\RoutePublicWeb {

	public function
	OnConstruct():
	Void {

		return;
	}

	public function
	Index($DocumentID):
	Void {

		$Document = App\Document::GetByDocumentID(
			App\Site\Filters::DocumentID($DocumentID)
		);

		$this->Surface->Set('App.Document',$Document);
		$this->Surface->Area('doc/view');
		return;
	}

}