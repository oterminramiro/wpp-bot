<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

class MailerManager
{
	public $CI;
	public $sendgrid;

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->sendgrid = new SendGrid(AppConfig::get()['sendgrid']['api']);
	}

	public function recoverPassword($user,$code)
	{
		$language = Language::where('IdLanguage',$user->IdLanguage)->first();
		$this->CI->lang->load('email',$language->Label);

		$body = $this->CI->load->view('email/template',[
			'title' => $this->CI->lang->line('email_recover_password_title'),
			'content' => 'email/views/recover_password',
			'hidelogo' => true,
			'user' => $user,
			'code' => $code
		],TRUE);

		$email = new \SendGrid\Mail\Mail();
		$email->setFrom(AppConfig::get()['sendgrid']['from'], AppConfig::get()['sendgrid']['name']);
		$email->setSubject($this->CI->lang->line('email_recover_password_title'));
		$email->addTo($user->Email);
		$email->addContent(
			"text/html", $body
		);

		try
		{
			$response = $this->sendgrid->send($email);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}

	public function updatePassword($user)
	{
		$language = Language::where('IdLanguage',$user->IdLanguage)->first();
		$this->CI->lang->load('email',$language->Label);

		$body = $this->CI->load->view('email/template',[
			'title' => $this->CI->lang->line('email_recover_success_title'),
			'content' => 'email/views/recover_success',
			'hidelogo' => true,
			'user' => $user,
		],TRUE);

		$email = new \SendGrid\Mail\Mail();
		$email->setFrom(AppConfig::get()['sendgrid']['from'], AppConfig::get()['sendgrid']['name']);
		$email->setSubject($this->CI->lang->line('email_recover_success_title'));
		$email->addTo($user->Email);
		$email->addContent(
			"text/html", $body
		);

		try
		{
			$response = $this->sendgrid->send($email);
		}
		catch (Exception $e)
		{
			echo 'Caught exception: '. $e->getMessage() ."\n";
		}
	}

	public function sendPassword($user,$pass)
	{
		$language = Language::where('IdLanguage',$user->IdLanguage)->first();
		$this->CI->lang->load('email',$language->Label);

		$body = $this->CI->load->view('email/template',[
			'title' => $this->CI->lang->line('email_password_send_title'),
			'content' => 'email/views/send_password',
			'hidelogo' => true,
			'user' => $user,
			'pass' => $pass,
		],TRUE);


		$email = new \SendGrid\Mail\Mail();
		$email->setFrom(AppConfig::get()['sendgrid']['from'], AppConfig::get()['sendgrid']['name']);
		$email->setSubject($this->CI->lang->line('email_password_send_title'));
		$email->addTo($user->Email);
		$email->addContent(
			"text/html", $body
		);

		try
		{
			$response = $this->sendgrid->send($email);
		}
		catch (Exception $e)
		{
			echo 'Caught exception: '. $e->getMessage() ."\n";
		}
	}

}
