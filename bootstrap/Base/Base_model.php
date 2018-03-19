<?php

namespace Bootstrap\Base;

class Base_model {

	// protected $dbbb;
	// protected $dbwms;
	protected $dbonedeca;
	
	public function __construct($app){
		// $this->dbbb = $app->get('dbbb');
		// $this->dbwms = $app->get('dbwms');
		$this->dbonedeca = $app->get('dbonedeca');
	}

}