<?php

class AuthController extends Zend_Controller_Action
{

	public function init()
	{

	}

	public function logoutAction()
	{
		$auth = Zend_Auth::getInstance();
		$auth->clearIdentity();
		return $this->_helper->redirector('auth');
	}
	
	
	
	
	
}