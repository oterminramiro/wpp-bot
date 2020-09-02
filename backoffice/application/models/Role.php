<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Role extends Eloquent
{
	public $table = "Role";
	public $primaryKey = 'IdRole';
	public $timestamps = false;
}
