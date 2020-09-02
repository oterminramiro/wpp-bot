<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends AdminController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function managers()
	{
		if(!$this->sessionManager->checkRole(['ADMIN','MANAGER'])) show_404();
		$crud = $this->_getGroceryCrudEnterprise();

		$crud->setTable('User');
		$crud->unsetBootstrap();
		$crud->unsetJquery();
		$crud->setSkin('bootstrap-v4');

		$crud->setLanguage(ucfirst($this->session->userdata('language_label')));

		$crud->displayAs('IdLanguage',$this->lang->line('app_crud_rate_user_language_id'));
		$crud->displayAs('IdRole',$this->lang->line('app_crud_rate_user_role_id'));
		$crud->displayAs('Email',$this->lang->line('app_crud_rate_user_username'));
		$crud->displayAs('Password',$this->lang->line('app_crud_rate_user_password'));
		$crud->displayAs('IdOrganization',$this->lang->line('app_crud_rate_user_organization_id'));

		$crud->setActionButton($this->lang->line('app_crud_rate_user_login_as'), 'fa fa-user-secret', function ($row) {
			$user = User::where('IdUser',$row->IdUser)->first();
			return '/manage/users/login_as/' . $user->Guid;
		}, false);

		$crud->setActionButton($this->lang->line('app_crud_rate_user_send_password'), 'fal fa-envelope-open send-mail', function ($row) {
			$user = User::where('IdUser',$row->IdUser)->first();
			return '/manage/users/send_password/' . $user->Guid;
		}, false);

		$crud->setRelation('IdLanguage','Language','Name');

		if($this->sessionManager->checkRole(['ADMIN']))
		{
			$crud->fields(['IdOrganization','IdLanguage','Email']);
			$crud->columns(['IdOrganization','Email','Created']);
			$crud->setRelation('IdOrganization','Organization','Name', ['Deleted' => NULL]);

			$crud->callbackBeforeInsert(function ($stateParameters) {
				$stateParameters->data['IdRole'] = Role::MANAGER;
				$stateParameters->data['Guid'] = guid();
				$stateParameters->data['Password'] = encrypt_decrypt('encrypt', guid());
				$stateParameters->data['Created'] = date_now();
				$stateParameters->data['Updated'] = date_now();

				return $stateParameters;
			});

			$crud->where([
				'User.IdRole' => Role::MANAGER,
				'User.Deleted' => NULL
			]);
		}
		else
		{
			$crud->fields(['IdLanguage','Email']);
			$crud->columns(['Email','Created']);

			$crud->callbackBeforeInsert(function ($stateParameters) {
				$stateParameters->data['IdOrganization'] = $this->user->IdOrganization;
				$stateParameters->data['IdRole'] = Role::MANAGER;
				$stateParameters->data['Guid'] = guid();
				$stateParameters->data['Password'] = encrypt_decrypt('encrypt', guid());
				$stateParameters->data['Created'] = date_now();
				$stateParameters->data['Updated'] = date_now();

				return $stateParameters;
			});

			$crud->where([
				'User.IdRole' => Role::MANAGER,
				'User.Deleted' => NULL,
				'User.IdOrganization' => $this->user->IdOrganization,
			]);
		}



		$output = $crud->render();

		if ($output->isJSONResponse) {
			header('Content-Type: application/json; charset=utf-8');
			echo $output->output;
			exit;
		}
		// APPEND
		$output->js_files[] = '/assets/views/app/modal.js';

		$this->load->view('app/template', [
			'title' => $this->lang->line('app_crud_rate_user_title_manager'),
			'content' => 'app/views/crud',
			'output' => $output->output,
			'css_files' => $output->css_files,
			'js_files' => $output->js_files
		]);
	}

	public function operators()
	{
		if(!$this->sessionManager->checkRole(['ADMIN','MANAGER'])) show_404();
		$crud = $this->_getGroceryCrudEnterprise();

		$crud->setTable('User');
		$crud->unsetBootstrap();
		$crud->unsetJquery();
		$crud->setSkin('bootstrap-v4');

		$crud->setLanguage(ucfirst($this->session->userdata('language_label')));

		$crud->displayAs('IdLanguage',$this->lang->line('app_crud_rate_user_language_id'));
		$crud->displayAs('IdRole',$this->lang->line('app_crud_rate_user_role_id'));
		$crud->displayAs('Email',$this->lang->line('app_crud_rate_user_username'));
		$crud->displayAs('Password',$this->lang->line('app_crud_rate_user_password'));
		$crud->displayAs('IdOrganization',$this->lang->line('app_crud_rate_user_organization_id'));

		$crud->setActionButton($this->lang->line('app_crud_rate_user_login_as'), 'fa fa-user-secret', function ($row) {
			$user = User::where('IdUser',$row->IdUser)->first();
			return '/manage/users/login_as/' . $user->Guid;
		}, false);

		$crud->setActionButton($this->lang->line('app_crud_rate_user_send_password'), 'fal fa-envelope-open send-mail', function ($row) {
			$user = User::where('IdUser',$row->IdUser)->first();
			return '/manage/users/send_password/' . $user->Guid;
		}, false);


		$crud->setRelation('IdLanguage','Language','Name');

		if($this->sessionManager->checkRole(['ADMIN']))
		{
			$crud->fields(['IdOrganization','IdLanguage','Email']);
			$crud->columns(['IdOrganization','Email','Created']);
			$crud->setRelation('IdOrganization','Organization','Name', ['Deleted' => NULL]);

			$crud->callbackBeforeInsert(function ($stateParameters) {
				$stateParameters->data['IdRole'] = Role::OPERATOR;
				$stateParameters->data['Guid'] = guid();
				$stateParameters->data['Password'] = encrypt_decrypt('encrypt', guid());
				$stateParameters->data['Created'] = date_now();
				$stateParameters->data['Updated'] = date_now();

				return $stateParameters;
			});

			$crud->where([
				'User.IdRole' => Role::OPERATOR,
				'User.Deleted' => NULL
			]);
		}
		else
		{
			$crud->fields(['IdLanguage','Email']);
			$crud->columns(['Email','Created']);

			$crud->callbackBeforeInsert(function ($stateParameters) {
				$stateParameters->data['IdOrganization'] = $this->user->IdOrganization;
				$stateParameters->data['IdRole'] = Role::OPERATOR;
				$stateParameters->data['Guid'] = guid();
				$stateParameters->data['Password'] = encrypt_decrypt('encrypt', guid());
				$stateParameters->data['Created'] = date_now();
				$stateParameters->data['Updated'] = date_now();

				return $stateParameters;
			});

			$crud->where([
				'User.IdRole' => Role::OPERATOR,
				'User.Deleted' => NULL,
				'User.IdOrganization' => $this->user->IdOrganization,
			]);
		}

		$output = $crud->render();

		if ($output->isJSONResponse) {
			header('Content-Type: application/json; charset=utf-8');
			echo $output->output;
			exit;
		}
		// APPEND
		$output->js_files[] = '/assets/views/app/modal.js';

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
		if(!$guid) show_404();

		$user = User::where('Guid',$guid)->first();

		if(!$user) show_404();

		$currentUser = $this->user;

		$cookie = array(
			'name'   => 'lastUser',
			'value'  => json_encode(encrypt_decrypt('encrypt', $currentUser->IdUser)),
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

		$user->Password = encrypt_decrypt('encrypt', $pass);
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
