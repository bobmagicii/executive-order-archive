<?php

namespace Routes;
use \App    as App;
use \Routes as Routes;
use \Nether as Nether;

class Home
extends App\Site\RoutePublicWeb {

	protected function
	OnConstruct():
	Void {

		$this->Get
		->Page('App\Site\Filters::PageNumber');

		return;
	}

	public function
	Index():
	Void {

		$TermData = App\Term::GetMonthlySummary();
		$PresidentSummary = App\Term::GetPresidentSummary();

		$Recent = App\Document::Search([
			'Sort'  => 'newest',
			'Page'  => $this->Get->Page,
			'Limit' => 10
		]);

		////////

		$this->Surface->Set('Home.PresidentSummary',$PresidentSummary);
		$this->Surface->Set('Home.TermSummary',$TermData);
		$this->Surface->Set('RecentDocuments',$Recent);

		if($this->Get->Page === 1)
		$this->Surface->Area('home/chart-primary');

		$this->Surface->Area('home/orders-recent');
		return;
	}

}
