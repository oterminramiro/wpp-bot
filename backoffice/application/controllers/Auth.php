<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends AuthController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->login();
	}

	public function login($recoverpass = NULL, $messages = NULL)
	{
		if($recoverpass != null)
		{
			$messages = $this->load->view('auth/views/partials/message_success',[
				'message' => $this->lang->line('app_auth_recover_sucess')
			],TRUE);
		}
		if($this->input->method(TRUE) == 'POST')
		{
			try {

				$this->form_validation->set_rules('username', 'username', 'required|trim|max_length[100]');
				$this->form_validation->set_rules('password', 'password', 'required|trim|max_length[100]');
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

				if ($this->form_validation->run() == FALSE)
				{
					$messages = validation_errors();
				}
				else
				{
					$user = User::where('Email','=',set_value('username'))
								->where('Password','=',encrypt_decrypt('encrypt', set_value('password')))
								->first();

					if($user)
					{
						$this->sessionManager->makeSessionByUser($user);
						redirect('/manage/dashboard');
					}
					else
					{
						// Stop showing recover pass success message and show error
						$messages = $this->load->view('auth/views/partials/message_error',[
							'message' => $this->lang->line('app_auth_login_notfound')
						],TRUE);
					}
				}

			}
			catch (Exception $e)
			{

				print_r($e);
				exit;
				$messages = $this->load->view('auth/views/partials/message_error',[
					'message' => $this->lang->line('app_auth_login_server')
				],TRUE);
			}
		}

		$this->load->view('auth/template', [
			'messages' => $messages,
			'content' => 'auth/views/login',
			'auth' => true
		]);

	}

	public function forgot_password($messages = NULL)
	{
		if($this->input->method(TRUE) == 'POST')
		{

			$this->form_validation->set_rules('username', 'username', 'required|trim|max_length[100]');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

			if ($this->form_validation->run() == FALSE)
			{
				$messages = validation_errors();
			}
			else
			{
				$user = User::where('Email','=',set_value('username'))->first();

				if($user)
				{
					$UserRecovery = new UserRecovery;
					$UserRecovery->IdUser = $user->IdUser;
					$UserRecovery->Guid = guid();
					$UserRecovery->Created = date_now();
					$UserRecovery->Updated = date_now();
					$save = $UserRecovery->save();
					if($save)
					{
						$mailer = new MailerManager;
						$mailer->recoverPassword($user,$UserRecovery->Guid);
						redirect('auth/checkmail');
					}
				}
				else
				{
					$messages = $this->load->view('auth/views/partials/message_error',[
						'message' => $this->lang->line('app_auth_forget_notfound')
					],TRUE);
				}
			}
		}

		$this->load->view('auth/template', [
			'content' => 'auth/views/forgot',
			'messages' => $messages,
		]);
	}

	public function checkmail()
	{
		$this->load->view('auth/template', [
			'content' => 'auth/views/checkmail'
		]);
	}

	public function recover_password($guid = NULL)
	{
		if($guid == NULL) show_404();

		if($this->session->userdata('IsLogged') == TRUE) redirect('/manage/dashboard/index');

		$userRecovery = UserRecovery::where('Guid', '=', $guid )->first();

		if(empty($userRecovery) || !$userRecovery->count() > 0) show_404();

		$this->load->view('auth/template', [
			'content' => 'auth/views/newpassword',
			'guid' => $guid,
			'auth' => true
		]);
	}

	public function new_password($messages = NULL)
	{
		if($this->input->method(TRUE) == 'POST')
		{
			try
			{
				if($this->session->userdata('IsLogged') == TRUE) redirect('/manage/dashboard/index');

				$userRecovery = UserRecovery::where('Guid', '=', set_value('guid') )->first();
				if($userRecovery)
				{
					$postData = $this->input->post();
					$this->form_validation->set_rules('Passwordone', 'Password', 'required|trim|max_length[100]');
					$this->form_validation->set_rules('Passwordtwo', 'Password confirmation', 'required|trim|max_length[100]|matches[Passwordone]');
					$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

					if ($this->form_validation->run() == FALSE)
					{
						$messages = validation_errors();
					}
					else
					{
						$user = User::where('IdUser','=',$userRecovery->IdUser)->first();
						if($user)
						{
							$newpass = encrypt_decrypt('encrypt', set_value('Passwordone'));
							$user->Password = $newpass;
							$user->save();
							redirect('/auth/login/true');
						}
						else
						{
							$messages = $this->load->view('auth/views/partials/message_error',[
								'message' => $this->lang->line('app_auth_forget_notfound')
							],TRUE);
						}
					}
				}
				else
				{
					show_404();
				}
			}
			catch (Exception $e)
			{
				$messages = $this->load->view('auth/views/partials/message_error',[
					'message' => $this->lang->line('app_auth_login_server')
				],TRUE);
			}

		}
		$this->load->view('auth/template', [
			'messages' => $messages,
			'content' => 'auth/views/newpassword',
			'guid' => $userRecovery->Guid,
			'auth' => true
		]);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/auth/login');
	}
}
