<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class UserRecovery extends Eloquent 
{ 		
	public $table = "UserRecovery";
	public $primaryKey = 'IdUserRecovery';	

 	const CREATED_AT = 'Created';
	const UPDATED_AT = 'Updated';
	const DELETED_AT = 'Deleted';	     
	
	public function User()
	{
		return $this->belongsTo('User','IdUser','IdUser');
	}	

}