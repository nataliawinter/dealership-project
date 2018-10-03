
<?php

class NoticiasController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $usuario = Zend_Auth::getInstance()->getIdentity();
        $this->view->usuario = $usuario;
    }

    public function init()
    {
        if (!Zend_Auth::getInstance()->hasIdentity()) {
            return $this->_helper->redirector->goToRoute( array('controller' => 'noticias'), null, true);
        }
    }
}
