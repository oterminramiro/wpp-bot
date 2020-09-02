<?php

abstract class BaseController extends CI_Controller
{	
	public $user;	
	
	public function __construct()
	{
		parent::__construct();			
		$this->sessionManager = new SessionManager;
	}		
}