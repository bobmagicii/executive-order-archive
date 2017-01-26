<?php

namespace App\Site;
use \App    as App;
use \Nether as Nether;

class RoutePublicAPI
extends App\Site\RoutePublicWeb {

	public function
	__construct() {
		parent::__construct();

		$this->Surface
		->SetTheme('json')
		->Set('api:error',0)
		->Set('api:message','OK')
		->Set('api:location',NULL)
		->Set('api:payload',[]);

		header('Content-type: application/json');

		return;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	public function
	SetError(Int $Number):
	self {

		$this->Surface->Set('api:error',$Number);
		return $this;
	}

	public function
	SetLocation(String $URL):
	self {

		$this->Surface->Set('api:location',$URL);
		return $this;
	}

	public function
	SetMessage(String $Text):
	self {

		$this->Surface->Set('api:message',$Text);
		return $this;
	}

	public function
	SetPayload(Array $Input, Bool $Overwrite=FALSE):
	self {

		$Output = [];

		////////

		if(!$Overwrite)
		$Output = $this->Surface->Get('api:payload');

		////////

		$this->Surface
		->Set('api:payload',array_merge(
			$Output,
			$Input
		));

		return $this;
	}

}
