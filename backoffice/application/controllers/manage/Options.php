<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Options extends AdminController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->options();
	}

	public function options()
	{
		$crud = $this->_getGroceryCrudEnterprise();

		$crud->setTable('Option');
		$crud->unsetBootstrap();
		$crud->unsetJquery();
		$crud->setSkin('bootstrap-v4');

		$crud->setLanguage(ucfirst($this->session->userdata('language_label')));

		$crud->displayAs('IdOrganization',$this->lang->line('app_crud_option_id_organization'));
		$crud->displayAs('IdOptionType',$this->lang->line('app_crud_option_id_option_type'));
		$crud->displayAs('Name',$this->lang->line('app_crud_option_name'));
		$crud->displayAs('Order',$this->lang->line('app_crud_option_order'));
		$crud->displayAs('KeyWord',$this->lang->line('app_crud_option_key_word'));
		$crud->displayAs('IdOptionValue',$this->lang->line('app_crud_option_id_option_value'));
		$crud->displayAs('Created',$this->lang->line('app_crud_option_created'));

		$crud->setRelation('IdOptionType','OptionType','Name');

		$crud->callbackColumn('IdOptionValue', function ($value, $row) {
			$this_option = Option::where('IdOption',$row->IdOption)->first();
			$options = Option::where('IdOptionValue',$this_option->IdOption)->get();
			if(count($options) == 0)
			{
				$output = '<a class="badge badge-soft-secondary" href="/manage/options/options_value/'.$this_option->Guid.'" >'.$this->lang->line('app_crud_option_no_options').'</a>';
			}
			else
			{
				$output = '<a class="badge badge-soft-secondary" href="/manage/options/options_value/'.$this_option->Guid.'" >'.$this->lang->line('app_crud_option_options').'('.count($options).')</a>';
			}
			return $output;
		});

		if($this->sessionManager->checkRole(['ADMIN']))
		{
			$crud->fields(['IdOrganization','IdOptionType','Name','Order','KeyWord']);
			$crud->columns(['IdOrganization','IdOptionType','Name','Order','KeyWord','IdOptionValue','Created']);

			$crud->setRelation('IdOrganization','Organization','Name', ['Deleted' => NULL]);

			$crud->callbackBeforeInsert(function ($stateParameters) {
				$stateParameters->data['Guid'] = guid();
				$stateParameters->data['Created'] = date_now();
				$stateParameters->data['Updated'] = date_now();

				return $stateParameters;
			});

			$crud->where([
				'Option.Deleted' => NULL
			]);
		}
		else
		{
			$crud->fields(['IdOptionType','Name','Order','KeyWord']);
			$crud->columns(['IdOptionType','Name','Order','KeyWord','IdOptionValue','Created']);

			$crud->callbackBeforeInsert(function ($stateParameters) {
				$stateParameters->data['IdOrganization'] = $this->user->IdOrganization;
				$stateParameters->data['Guid'] = guid();
				$stateParameters->data['Created'] = date_now();
				$stateParameters->data['Updated'] = date_now();

				return $stateParameters;
			});

			$crud->where([
				'Option.Deleted' => NULL,
				'Option.IdOrganization' => $this->user->IdOrganization
			]);
		}

		$output = $crud->render();

		if ($output->isJSONResponse) {
			header('Content-Type: application/json; charset=utf-8');
			echo $output->output;
			exit;
		}
		// APPEND
		#$output->js_files[] = '/assets/views/manage/modal.js';

		$this->load->view('app/template', [
			'title' => $this->lang->line('app_crud_option_title'),
			'content' => 'app/views/crud',
			'output' => $output->output,
			'css_files' => $output->css_files,
			'js_files' => $output->js_files
		]);

	}
}
