<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends AdminController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function account($messages = NULL)
	{
		if($this->input->method(TRUE) == 'POST')
		{

			$this->form_validation->set_rules('Password', 'Password', 'required|trim|max_length[100]');
			$this->form_validation->set_rules('RepeatPassword', 'RepeatPassword', 'required|trim|max_length[100]|matches[Password]');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');

			if ($this->form_validation->run() == FALSE)
			{
				$messages = validation_errors();
			}
			else
			{
				$messages = $this->load->view('auth/views/partials/message_success',[
					'message' => $this->lang->line('app_account_password_updated')
				],TRUE);
				$this->user->Password = encrypt_decrypt('encrypt', set_value('Password'));
				$this->user->save();
			}
		}

		$this->load->view('app/template', [
			'title' => $this->lang->line('app_account_title'),
			'user' => $this->user,
			'messages_password' => $messages,
      		'content' => 'app/views/account/account'
    	]);
	}

	public function language($messages = null)
	{
		if($this->input->method(TRUE) == 'POST')
		{
			$this->form_validation->set_rules('language', 'language', 'required');
			$this->form_validation->set_error_delimiters('', '');
			if ($this->form_validation->run() == FALSE)
			{
				$messages = $this->load->view('auth/views/partials/message_error',[
					'message' => $this->lang->line('app_account_error')
				],TRUE);
			}
			else
			{
				$this->user->IdLanguage = set_value('language');
				$this->user->save();
				$this->sessionManager->makeSessionByUser($this->user);
				$messages = $this->load->view('auth/views/partials/message_success',[
					'message' => $this->lang->line('app_account_language_updated')
				],TRUE);
			}
		}

		$this->load->view('app/template', [
			'title' => $this->lang->line('app_account_title'),
			'user' => $this->user,
			'messages_password' => $messages,
      		'content' => 'app/views/account/account'
    	]);
	}

	public function logout()
	{
		if(get_cookie('lastUser'))
		{
			$user = User::find(encrypt_decrypt('decrypt', get_cookie('lastUser')));
			if(!$user)
			{
				delete_cookie('lastUser');
				$this->session->sess_destroy();
			}
			else
			{
				delete_cookie('lastUser');
				$this->sessionManager->makeSessionByUser($user);
			}

			redirect('/manage/dashboard/index');
		}

		$this->session->sess_destroy();
		redirect('/auth/login');
	}
}
