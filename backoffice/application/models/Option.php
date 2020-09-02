<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Option extends Eloquent
{
	public $table = 'BotOption';
	public $primaryKey = 'IdBotOption';
	public $timestamps = false;
}
