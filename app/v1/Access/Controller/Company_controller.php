<?php

namespace App\Access\Controller;

use Interop\Container\ContainerInterface;
use Bootstrap\Base\Base_controller;

use App\Access\Service\Company_service;

class Company_controller extends Base_controller {

	public function __construct(ContainerInterface $app) {
		parent::__construct($app);
	}

    public function insert(){
        $request = $this->DI->get('request');
        $service = New Company_service($this->DI);

        $process_data = $service->insert_company($request);

        return $this->DI->get('response')->withStatus(200)
                ->withHeader('Content-Type', 'application/json')
                ->write(json_encode($process_data));
    }

}