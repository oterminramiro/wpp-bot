<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class OptionType extends Eloquent
{
	public $table = "OptionType";
	public $primaryKey = 'IdOptionType';
	public $timestamps = false;

	const TEXT = 1;
}
