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

		if(!$Document) {
			$this->Surface->Area('error/not-found');
			return;
		}

		$this->Surface->Set('App.Document',$Document);
		$this->Surface->Area('doc/view');
		return;
	}

	public function
	ArchivePassThru($DocumentID):
	Void {

		$Document = App\Document::GetByDocumentID(
			App\Site\Filters::DocumentID($DocumentID)
		);

		if(!$Document || !$Document->GetArchivePath()) {
			$this->Surface->Area('error/not-found');
			return;
		}

		$this->Surface->Stop(TRUE);

		header('Content-type: application/pdf');
		readfile($Document->GetArchivePath());

		return;
	}

}