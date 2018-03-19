<?php

namespace App\Access\Model;

use Bootstrap\Base\Base_model;

class Company_model extends Base_model {

	public function __construct($app) {
		parent::__construct($app);
	}

	public function insert_company($request){

		$sql = "INSERT INTO company(name, description, status, created_by, created_date)
                VALUES(:name, :description, :status, :created_by, :created_date)";

        $query = $this->dbonedeca->prepare($sql);

        $bind = array(
        	'name' => $request->getParam('name'),
        	'description' => $request->getParam('description'),
        	'status' => $request->getParam('status'),
        	'created_by' => $request->getParam('created_by'),
        	'created_date' => $request->getParam('created_date')
        );

        try{
	        $query->execute($bind);
	        return build_response(true, 'Data Company Berhasil disimpan.');
	    }catch(\PDOExeption $e){
	    	return build_response(false, $e->getMessage());
	    }
	}
	
}