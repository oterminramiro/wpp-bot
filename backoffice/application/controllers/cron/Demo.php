<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends CronController
{
	public function __construct()
	{
		parent::__construct();
    }

	public function handler()
	{
        $this->demo();
    }

	public function demo()
	{
        continue;
    }
}
