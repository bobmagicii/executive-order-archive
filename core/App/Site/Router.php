<?php

namespace App\Site;
use \App    as App;
use \Nether as Nether;

class Router
extends Nether\Avenue\Router {

	public function
	__construct($Opt=NULL) {
		parent::__construct($Opt);

		$this
		->AddRoute('{@}//index','Routes\Home::Index')
		->AddRoute('{@}//about','Routes\About::Index')
		->AddRoute('{@}//api','Routes\Api::Index');

		$this
		->AddRoute('{@}//api-web/v1/test','Routes\ApiWeb1\Test::Index');

		Nether\Ki::Queue(
			'surface-render-scope',
			function(Array &$Scope):
			Void {
				$Scope['router'] = $this;
				return;
			},
			TRUE
		);

		return;
	}

}
