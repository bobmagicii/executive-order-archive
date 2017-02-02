<?php

namespace App;
use \App    as App;
use \Nether as Nether;

use \DateTime     as DateTime;
use \DateInterval as DateInterval;

class Term {

	static
	$List = [
		'Clinton Term 1' => [
			'Term'     => 1,
			'Start'    => '1993-01-20',
			'End'      => '1997-01-19',
			'SignedBy' => 'william-j-clinton',
			'LineColour' => '#0660A9'
		],
		'Clinton Term 2' => [
			'Term'     => 2,
			'Start'    => '1997-01-20',
			'End'      => '2001-01-19',
			'SignedBy' => 'william-j-clinton',
			'LineColour' => '#348DC7'
		],
		'Bush Jr. Term 1' => [
			'Term'     => 1,
			'Start'    => '2001-01-20',
			'End'      => '2005-01-19',
			'SignedBy' => 'george-w-bush',
			'LineColour' => '#ED1C23'
		],
		'Bush Jr. Term 2' => [
			'Term'     => 2,
			'Start'    => '2005-01-20',
			'End'      => '2009-01-19',
			'SignedBy' => 'george-w-bush',
			'LineColour' => '#E7454B'
		],
		'Obama Term 1' => [
			'Term'     => 1,
			'Start'    => '2009-01-20',
			'End'      => '2013-01-19',
			'SignedBy' => 'barack-obama',
			'LineColour' => '#F0F0F0'
		],
		'Obama Term 2' => [
			'Term'     => 2,
			'Start'    => '2013-01-20',
			'End'      => '2017-01-19',
			'SignedBy' => 'barack-obama',
			'LineColour' => '#B0B0B0'
		],
		'Trump Term 1' => [
			'Term'     => 1,
			'Start'    => '2017-01-20',
			'End'      => '2021-01-19',
			'SignedBy' => 'donald-trump',
			'LineColour' => '#DDAD65'
		]
	];

	static public function
	GetPresidentSummary():
	Array {

		$Output = [];
		$Result = NULL;
		$SQL = Nether\Database::Get()->NewVerse();

		$Result = $SQL
		->Select('Documents')
		->Fields([
			'doc_signed_by AS Who',
			'COUNT(*) AS TotalCount'
		])
		->Sort('TotalCount')
		->Group('doc_signed_by')
		->Query();

		while($Row = $Result->Next())
		$Output[$Row->Who] = $Row->TotalCount;

		return $Output;
	}

	static public function
	GetMonthlySummary():
	Array {

		$Iter; $Start; $End;
		$Label; $Data;

		$Output = [];
		$Result = NULL;
		$SQL= Nether\Database::Get()->NewVerse();

		////////

		foreach(self::$List as $Label => $Data) {

			// prepare a dataset in the event one of them managed to go
			// an entire month without signing something. also future
			// proof it in the event we have data for a president who did
			// not serve a full term lol.

			$Output[$Label] = [];
			$Start = new DateTime($Data['Start']);
			$End = new DateTime($Data['End']);
			$Iter = 0;

			do {
				if($Iter > 0)
				$Start->Add(new DateInterval("P1M"));

				$Output[$Label][$Start->Format('Y-m')] = 0;

				$Iter++;
			} while($Start < $End && $Iter <= (12*24));

			// now find their actual data and fill it in overwriting the
			// blank set we created.

			$Result = $SQL
			->Select('Documents')
			->Fields([
				'COUNT(*) AS MonthCount',
				'DATE_FORMAT(doc_date_signed,"%Y-%m") PubKey'
			])
			->Where([
				'doc_signed_by LIKE :SignedBy',
				'doc_date_signed BETWEEN :Start AND :End'
			])
			->Group('PubKey')
			->Query($Data);

			while($Row = $Result->Next())
			$Output[$Label][$Row->PubKey] = (Int)$Row->MonthCount;
		}

		//echo "<pre>";
		//print_r($Output);
		//echo "</pre>";

		return $Output;
	}

}
