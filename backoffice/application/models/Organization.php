<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Organization extends Eloquent
{
	public $table = "Organization";
	public $primaryKey = 'IdOrganization';
	public $timestamps = false;

	public function delete()
	{
		return parent::delete();
	}

}
