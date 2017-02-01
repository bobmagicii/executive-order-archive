<?php

namespace App;
use \App    as App;
use \Nether as Nether;

class Term {

	static
	$List = [
		'Clinton Term 1' => [
			'Start'    => '1993-01-20',
			'End'      => '1997-01-19',
			'SignedBy' => 'william-clinton'
		],
		'Clinton Term 2' => [
			'Start'    => '1997-01-20',
			'End'      => '2001-01-19',
			'SignedBy' => 'william-clinton'
		],
		'Bush Jr. Term 1' => [
			'Start'    => '2001-01-20',
			'End'      => '2005-01-19',
			'SignedBy' => 'george-w-bush'
		],
		'Bush Jr. Term 2' => [
			'Start'    => '2005-01-20',
			'End'      => '2009-01-19',
			'SignedBy' => 'george-w-bush'
		],
		'Obama Term 1' => [
			'Start'    => '2009-01-20',
			'End'      => '2013-01-19',
			'SignedBy' => 'barack-obama'
		],
		'Obama Term 2' => [
			'Start'    => '2013-01-20',
			'End'      => '2017-01-19',
			'SignedBy' => 'barack-obama'
		],
		'Trump Term 1' => [
			'Start'    => '2017-01-20',
			'End'      => '2021-01-19',
			'SignedBy' => 'donald-trump'
		]
	];

	static public function
	GetPresidentSummary():
	Array {

		$Output = [];

		return $Output;
	}

	static public function
	GetMonthlySummary():
	Array {

		$Output = [];
		$Result = NULL;
		$SQL = Nether\Database::Get()->NewVerse();

		foreach(self::$List as $Label => $Data) {
			$Result = $SQL
			->Select('Documents')
			->Fields([
				'COUNT(*) AS MonthCount',
				'YEAR(doc_date_published) PubYear',
				'MONTH(doc_date_published) PubMonth'
			])
			->Where([
				'doc_signed_by LIKE :SignedBy',
				'doc_date_published BETWEEN :Start AND :End'
			])
			->Group('PubYear, PubMonth')
			->Query($Data);

			$Output[$Label] = [];

			while($Row = $Result->Next())
			$Output[$Label]["{$Row->PubYear}-{$Row->PubMonth}"] = (Int)$Row->MonthCount;
		}

		echo "<pre>";
		print_r($Output);
		echo "</pre>";

		return $Output;
	}

}
