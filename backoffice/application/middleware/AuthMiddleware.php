<?php

class AuthMiddleware implements Luthier\MiddlewareInterface
{
    public $sessionManager;	

    public function run($args)
    {
        $this->sessionManager = new SessionManager;
        if($this->sessionManager->getCurrentUser())
        {
            redirect('/manage/dashboard/');
        }
    }
}