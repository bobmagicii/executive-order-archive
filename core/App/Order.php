<?php

namespace App;
use \App    as App;
use \Nether as Nether;

class Order
extends Nether\Object {

	static public
	$PropertyMap = [
		'eo_id'             => 'ID:int',        // our internal id.
		'eo_president'      => 'President',     // who signed it.
		'eo_ordernum'       => 'OrderNumber',   // apparent format: YYYY-Numeral
		'eo_date_signed'    => 'DateSigned',    // day president signed it.
		'eo_date_published' => 'DatePublished', // day it was made public :z could be interesting.
		'eo_title'          => 'Title',         // title of the order.
		'eo_json_urls'      => 'JSONURLs'       // json object of all the urls for this order.
	];

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	protected
	$ID = 0;

	public function
	GetID():
	Int {

		return $this->ID;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	protected
	$OrderNumber = '';

	public function
	GetOrderNumber():
	String {

		return $this->OrderNumber;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	protected
	$DatePublished = '';

	public function
	GetDatePublished():
	String {

		return $this->DatePublished;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	protected
	$DateSigned = '';

	public function
	GetDateSigned():
	String {

		return $this->DateSigned;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	protected
	$Title = '';

	public function
	GetTitle():
	String {

		return $this->Title;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	protected
	$JSONURLs = '',
	$URLs     = NULL;

	public function
	GetURLs():
	Nether\Object\Datastore {

		return $this->URLs;
	}

	////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////

	protected function
	__ready():
	Void {

		$this->URLs = new Nether\Object\Datastore;

		$this->__ready_ParseJSONURLs();

		return;
	}

	protected function
	__ready_ParseJSONURLs():
	Void {

		$List = json_parse($this->JSONURLs);

		if(!is_array($List))
		$List = [];

		$this->URLs->SetData($URLs);
		return;
	}

}
