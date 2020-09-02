<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Option extends Eloquent
{
	public $table = 'Option';
	public $primaryKey = 'IdOption';
	public $timestamps = false;
}
