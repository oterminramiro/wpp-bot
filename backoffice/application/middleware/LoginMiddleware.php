<?php

class LoginMiddleware implements Luthier\MiddlewareInterface
{
    public $sessionManager;	
    public $user;	

    public function run($args)
    {
        $this->sessionManager = new SessionManager;
        if($this->sessionManager->isLogged() == false)
        {
            redirect('/auth/login/');
        }
    }
}