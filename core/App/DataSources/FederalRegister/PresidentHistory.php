<?php

namespace App\DataSources\FederalRegister;
use \App    as App;
use \Nether as Nether;

class PresidentHistory
extends App\DataSources\FederalRegister {

	protected
	$Page = 1;

	protected
	$PageCount = 1;

	public function
	Query():
	App\DataSource {

		while($this->Page <= $this->PageCount) {
			$URL = str_replace('&page=1',"&page={$this->Page}",$this->URL);
			echo "Page {$this->Page}", PHP_EOL;

			$Raw = $this->Fetch($URL);
			$Result = $this->Parse($Raw);
			$Data = $this->Itemise($Result);

			$this->PageCount = (Int)$Result->total_pages;

			$this->GetItems()
			->BlendRight($Data);

			$this->Page++;

			usleep(500);
		}

		return $this;
	}

}
