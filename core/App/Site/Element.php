<?php

namespace App\Site;
use \App    as App;
use \Nether as Nether;

class Element {

	protected
	$Area = NULL;

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	public function
	__construct() {

		$this->OnConstruct(...func_get_args());
		return;
	}

	public function
	__toString():
	String {

		if($this->Area === NULL)
		return sprintf(
			'%s has no area set',
			static::class
		);

		return Nether\Stash::Get('surface')
		->GetArea($this->Area);
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	protected function
	OnConstruct():
	Void {

		return;
	}

}
