<?php

namespace App\Access\Service;

use Bootstrap\Base\Base_service;

use App\Access\Model\Company_model;

use Respect\Validation\Validator as v;

class Company_service extends Base_service {

	public function __construct($app) {
		parent::__construct($app);
	}

	public function insert_company($request){
		$validate = $this->_validate_company($request);

		if ($validate->failed()) {
			return build_response(false, $validate->getErrors());
        }else{
        	$company_model = New Company_model($this->DI);

        	$insert_data = $company_model->insert_company($request);

        	return $insert_data;
        }
	}

	private function _validate_company($request){
		return $this->DI->validator->validate($request,
            [
                'name' => v::notEmpty(),
                'description'  => v::notEmpty(),
                'status' => v::notEmpty(),
                'created_by'  => v::notEmpty(),
                'created_date' => v::notEmpty()
            ]);
	}
	
}