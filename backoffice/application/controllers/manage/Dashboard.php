<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends AdminController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->dashboard();
	}

	public function dashboard()
	{
		$this->load->view('app/template', [
			'title' => 'Dashboard',
			'content' => 'app/views/dashboard/dashboard',
		]);
	}
}
