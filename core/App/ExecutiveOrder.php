<?php

namespace App;
use \App    as App;
use \Nether as Nether;

class ExecutiveOrder
extends Nether\Object {

	static public
	$PropertyMap = [
		'eo_id'       => 'ID:int',
		'eo_ordernum' => 'OrderNumber',
		'eo_time'     => 'Date',
		'eo_title'    => 'Title',
		'eo_text'     => 'Text',
		'eo_url'      => 'URL'
	];

}
