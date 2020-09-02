<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Organizations extends AdminController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->organizations();
	}

	public function organizations()
	{
		if(!$this->sessionManager->checkRole(['ADMIN'])) show_404();
		$crud = $this->_getGroceryCrudEnterprise();

		$crud->setTable('Organization');
		$crud->unsetBootstrap();
		$crud->unsetJquery();
		$crud->setSkin('bootstrap-v4');

		$crud->setLanguage(ucfirst($this->session->userdata('language_label')));

		$crud->columns(['Name','Address','Created']);
		$crud->fields(['Name','Address']);



		$crud->displayAs('language_id',$this->lang->line('app_crud_rate_user_language_id'));
		$crud->displayAs('role_id',$this->lang->line('app_crud_rate_user_role_id'));
		$crud->displayAs('username',$this->lang->line('app_crud_rate_user_username'));
		$crud->displayAs('password',$this->lang->line('app_crud_rate_user_password'));
		$crud->displayAs('name',$this->lang->line('app_crud_rate_user_name'));
		$crud->displayAs('lastname',$this->lang->line('app_crud_rate_user_lastname'));
		$crud->displayAs('country_id',$this->lang->line('app_crud_rate_user_country_id'));
		$crud->displayAs('organization_id',$this->lang->line('app_crud_rate_user_organization_id'));

		$crud->callbackBeforeInsert(function ($stateParameters) {
			$stateParameters->data['Guid'] = guid();
			$stateParameters->data['Created'] = date_now();
			$stateParameters->data['Updated'] = date_now();

			return $stateParameters;
		});

		$output = $crud->render();

		if ($output->isJSONResponse) {
			header('Content-Type: application/json; charset=utf-8');
			echo $output->output;
			exit;
		}

		$this->load->view('app/template', [
			'title' => $this->lang->line('app_crud_rate_user_title_customer'),
			'content' => 'app/views/crud',
			'output' => $output->output,
			'css_files' => $output->css_files,
			'js_files' => $output->js_files
		]);

	}

	public function operators()
	{
		if(!$this->sessionManager->checkRole(['ADMIN','OPERATOR'])) show_404();
		$crud = $this->_getGroceryCrudEnterprise();

		$crud->setTable('user');
		$crud->unsetBootstrap();
		$crud->unsetJquery();
		$crud->setSkin('bootstrap-v4');

		$crud->unsetOperations();

		$crud->setLanguage(ucfirst($this->session->userdata('language_key')));

		$crud->displayAs('language_id',$this->lang->line('app_crud_rate_user_language_id'));
		$crud->displayAs('role_id',$this->lang->line('app_crud_rate_user_role_id'));
		$crud->displayAs('username',$this->lang->line('app_crud_rate_user_username'));
		$crud->displayAs('password',$this->lang->line('app_crud_rate_user_password'));
		$crud->displayAs('name',$this->lang->line('app_crud_rate_user_name'));
		$crud->displayAs('lastname',$this->lang->line('app_crud_rate_user_lastname'));
		$crud->displayAs('country_id',$this->lang->line('app_crud_rate_user_country_id'));
		$crud->displayAs('organization_id',$this->lang->line('app_crud_rate_user_organization_id'));

		$crud->setActionButton($this->lang->line('app_crud_rate_user_login_as'), 'fa fa-user-secret', function ($row) {
			$user = User::where('user_id',$row->user_id)->first();
			return '/manage/users/login_as/' . $user->guid;
		}, false);

		$crud->setActionButton($this->lang->line('app_crud_rate_user_send_password'), 'fal fa-envelope-open send-mail', function ($row) {
			$user = User::where('user_id',$row->user_id)->first();
			return '/manage/users/send_password/' . $user->guid;
		}, false);


		$crud->where([
			'user.role_id' => Role::OPERATOR
		]);

		$output = $crud->render();

		if ($output->isJSONResponse) {
			header('Content-Type: application/json; charset=utf-8');
			echo $output->output;
			exit;
		}
		// APPEND
		$output->js_files[] = '/assets/views/manage/modal.js';

		$this->load->view('app/template', [
			'title' => $this->lang->line('app_crud_rate_user_title_operator'),
			'content' => 'app/views/crud',
			'output' => $output->output,
			'css_files' => $output->css_files,
			'js_files' => $output->js_files
		]);

	}

	public function login_as($guid = null)
	{
		if(!$this->sessionManager->checkRole(['ADMIN','OPERATOR'])) show_404();

		if(!$guid) show_404();

		$user = User::where('guid',$guid)->first();

		if(!$user) show_404();

		$currentUser = $this->user;

		$cookie = array(
			'name'   => 'lastUser',
			'value'  => json_encode(encrypt_decrypt('encrypt', $currentUser->user_id)),
			'expire' => '86500',
		);

		$this->input->set_cookie($cookie);
		$this->sessionManager->makeSessionByUser($user);

		redirect('/manage/dashboard/index');
	}

	public function send_password($guid = null)
	{
		if($guid == NULL) show_404();
		$user = User::where('Guid',$guid)->first();
		if($user == NULL) show_404();

		$pass = random_string_app();

		$user->password = encrypt_decrypt('encrypt', $pass);
		$save = $user->save();
		if($save)
		{
			$mailer = new MailerManager;
			$mailer->sendPassword($user,$pass);
		}
		if ($this->input->server('REQUEST_METHOD') == 'GET')
		{
			redirect('/manage/dashboard/index');
		}
	}

}
