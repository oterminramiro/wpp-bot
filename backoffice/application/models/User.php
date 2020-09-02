<?php

use \Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
	public $table = "User";
	public $primaryKey = 'IdUser';
	public $timestamps = false;

	public function Organization()
	{
		return $this->belongsTo('Organization','IdOrganization','IdOrganization');
	}

	public function Role()
	{
		return $this->belongsTo('Role','IdRole','IdRole');
	}

	public function scopeGetByIdUser($query,$userId)
	{
		return $query->where('user_id', '=', $userId)->first();
	}

	public function scopeLogin($query,$username,$password)
	{
		$user = $query->where('username', '=', $username)
				->where('password', '=', encrypt_decrypt('encrypt', $password))
				->first();
		return $user;
	}

	public function delete()
	{
		return parent::delete();
	}
}
