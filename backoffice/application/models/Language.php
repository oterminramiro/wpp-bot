<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Language extends Eloquent
{
	public $table = 'Language';
	public $primaryKey = 'IdLanguage';
	public $timestamps = false;


	public function User()
	{
		return $this->hasMany('User', 'IdLanguage', 'IdLanguage');
	}
}
