<?php

class UsuarioController extends Zend_Controller_Action {

	public function init() {

	}

	function usuarioAction() {

		//select no banco na tabela albuns
		$usuario = new Application_Model_DbTable_Usuario();
		$this->view->usuario = $usuario->fetchAll();
	}

	function addusuarioAction() {
		//instancio a classe do formulario e jogo para a variavel
		//$form
		$form = new Application_Form_Usuario();
		$form->submit->setLabel('salvar');
		
		$this->view->form = $form;
		if ($this->getRequest()->isPost()) {

			$formData = $this->getRequest()->getPost();
			
			if ($form->isValid($formData)) {
				$nome = $form->getValue('Nome');
				$email = $form->getValue('Email');
				$senha = $form->getValue('Senha');
				$permissoes = $form->getValue('Permissao');
				
				$usuarios = new Application_Model_DbTable_Usuario();
				$usuarios->addUsuario($nome, $email, $senha, $permissoes);

				$this->_helper->redirector('usuario');
			} else {
				$form->populate($formData);
			}
		}
	}

	function editusuarioAction() {
		$form = new Application_Form_Usuario();
		$form->submit->setLabel('salvar');
		$this->view->form = $form;
		
		if ($this->getRequest()->isPost()) {
			
			$formData = $this->getRequest()->getPost();
			
			if ($form->isValid($formData)) {
				 
				$id = (int) $form->getValue('idUsuario');

				$nome = $form->getValue('Nome');
				$email = $form->getValue('Email');
				$senha = $form->getValue('Senha');
				$permissoes = $form->getValue('Permissao');

				$usuarios = new Application_Model_DbTable_Usuario();
				$usuarios->updateUsuario($id, $nome, $email, $senha, $permissoes);

				$this->_helper->redirector('usuario');
			} else {
				$form->populate($formData);
			}
		} else {
			$id = $this->_getParam('idUsuario', 0);
			if ($id > 0) {
				$usuarios = new Application_Model_DbTable_Usuario();
				$form->populate($usuarios->getUsuario($id));
			}
		}
	}

	public function deleteusuarioAction() {
		if ($this->getRequest()->isPost()) {
			
			$del = $this->getRequest()->getPost('del');
			if ($del == 'Yes') {
				
				$id = $this->getRequest()->getPost('idUsuario');
				
				$usuarios = new Application_Model_DbTable_Usuario();
				$usuarios->deleteUsuario($id);
			}
			$this->_helper->redirector('usuario');
		} else {
			$id = $this->_getParam('idUsuario', 0);

			$usuarios = new Application_Model_DbTable_Usuario();
			$this->view->usuario = $usuarios->getUsuario($id);
		}
	}

}

