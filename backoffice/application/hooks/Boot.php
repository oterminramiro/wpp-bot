<?php if (!defined( 'BASEPATH')) exit('No direct script access allowed');
 
class Boot
{
	private $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();		
	}
 
	public function init()
	{	
		if (ENVIRONMENT == 'development') 
		{
			$whoops = new \Whoops\Run;
			$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());
			$whoops->register();
		}
	}	
}