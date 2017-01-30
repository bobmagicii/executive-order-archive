<?php

namespace App\Site;
use \App    as App;
use \Nether as Nether;

class RoutePublicWeb {

	public function
	__construct() {

		$this->Router = Nether\Stash::Get('Router');
		$this->Surface = new Nether\Surface;
		$this->Get = new Nether\Input\Filter($_GET);
		$this->Post = new Nether\Input\Filter($_POST);

		Nether\Ki::Queue(
			'surface-render-scope',
			function(Array &$Scope):
			Void {
				$Scope['route'] = $this;
				return;
			},
			TRUE
		);

		$this->OnConstruct(...func_get_args());
		return;
	}

	protected function
	OnConstruct():
	Void {

		return;
	}

}
