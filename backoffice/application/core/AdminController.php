<?php

include(APPPATH . 'libraries/GroceryCrudEnterprise/autoload.php');

use GroceryCrud\Core\GroceryCrud;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as DB;

abstract class AdminController extends BaseController
{
	public $loggerManager;
	public $organization;

	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata('is_logged') == TRUE)
		{
			$this->user = User::where('IdUser','=',$this->session->userdata('user_id'))->first();
			if($this->user != NULL)
			{
				if($this->session->userdata('role_key') != 'ADMIN')
				{
					$this->organization = Organization::where('IdOrganization',$this->user->organization_id)->first();
				}

				// load the language
				$this->lang->load('app',$this->session->userdata('language_label'));
			}
		}
	}

	protected function _getDbData()
	{
		$db = [];
		return [
			'adapter' => [
				'driver' => AppConfig::get()['db']['driver'],
				'host'     => AppConfig::get()['db']['hostname'],
				'database' => AppConfig::get()['db']['database'],
				'username' => AppConfig::get()['db']['username'],
				'password' => AppConfig::get()['db']['password'],
				'port' => AppConfig::get()['db']['port'],
				'charset' => 'utf8'
			]
		];
	}

	protected function _getGroceryCrudEnterprise($bootstrap = true, $jquery = true)
	{
		$db = $this->_getDbData();
		$config = include(APPPATH . 'config/gcrud-enterprise.php');
		$groceryCrud = new GroceryCrud($config, $db);
		return $groceryCrud;
	}

}
