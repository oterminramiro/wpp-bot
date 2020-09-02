<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class SessionManager
{
	public $CI;
	public $User;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('session');
	}

	public function makeSessionByUser($user)
	{
		$language = Language::where('IdLanguage',$user->IdLanguage)->first();
		$this->CI->session->set_userdata([
			'user_id' => $user->IdUser,
			'username' => $user->Email,
			'is_logged' => 1,
			'role_key' => $user->Role->Key,
			'organization_id' => $user->IdOrganization,
			'language_label' => $language->Label,
			'language_code' => $language->Code,
		]);

		return TRUE;
	}

	public function showUsername()
	{
	  return $this->CI->session->userdata('username');
	}

	public function checkRole($array)
	{
		if (!in_array($this->CI->session->userdata('role_key'), $array))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	public function getCurrentUser()
	{
		$user = User::where('IdUser','=',$this->CI->session->userdata('user_id'))->first();
		return $user;
	}

	public function isLogged()
	{
		if(  $this->CI->session->userdata('is_logged') == FALSE )
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}
