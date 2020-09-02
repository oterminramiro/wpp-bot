<?php

abstract class AuthController extends BaseController
{
	public function __construct()
	{
		parent::__construct();
		$language = $this->input->get('language');

		if($language)
		{
			switch ($language){
				case "ES":
					$this->lang->load('app', 'spanish');
					$this->session->set_userdata('Code','ES');
					$this->session->set_userdata('Language','Spanish');
					break;
				case "EN":
					$this->lang->load('app', 'english');
					$this->session->set_userdata('Code','EN');
					$this->session->set_userdata('Language','English');
					break;
				case "PT":
					$this->lang->load('app', 'portuguese');
					$this->session->set_userdata('Code','PT');
					$this->session->set_userdata('Language','Portuguese');
					break;
				default:
					$this->lang->load('app', 'spanish');
					$this->session->set_userdata('Code','ES');
					$this->session->set_userdata('Language','Spanish');
					break;
			}
		}
		else
		{
			$language = $this->session->userdata('Code');

			switch ($language){
				case "ES":
					$this->lang->load('app', 'spanish');
					break;
				case "EN":
					$this->lang->load('app', 'english');
					break;
				case "PT":
					$this->lang->load('app', 'portuguese');
					break;
				default:
					$this->lang->load('app', 'english');
					break;
			}
		}


		// Si esta logueado redirecciono al dashboard
		if($this->session->userdata('IsLogged') == TRUE) redirect('/manage/dashboard/index');
	}
}
