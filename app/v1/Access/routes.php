<?php

$version = '/' . getenv("VERSION");

$app->group($version, function () {

	$this->post('/company/add', App\Access\Controller\Company_controller::class . ':insert');
	
});
