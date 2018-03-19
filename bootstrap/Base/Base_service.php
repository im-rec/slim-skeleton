<?php

namespace Bootstrap\Base;

class Base_service {

	protected $DI;

	public function __construct($app){
		$this->DI = $app;
	}

}