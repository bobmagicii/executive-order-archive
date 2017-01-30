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

		$this->OnRender();

		if($this->Area === NULL)
		return sprintf('%s has no area set',static::class);

		////////

		// provide access to the special var $element within the widget
		// template file. kept lower case to remain consistent with the
		// special var $this, given the context of the theme file.

		Nether\Ki::Queue(
			'surface-render-scope',
			function(Array &$Scope):
			Void {
				$Scope['element'] = $this;
				return;
			}
		);

		return
		Nether\Stash::Get('surface')
		->GetArea($this->Area);
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	protected function
	OnConstruct():
	Void {

		return;
	}

	protected function
	OnRender():
	Void {

		return;
	}

}
