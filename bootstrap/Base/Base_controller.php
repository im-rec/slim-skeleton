<?php

namespace Bootstrap\Base;

class Base_controller {

	protected $DI;

	public function __construct($app){
		$this->DI = $app;
	}

}