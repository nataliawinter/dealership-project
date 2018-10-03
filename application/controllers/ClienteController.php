<?php

class ClienteController extends Zend_Controller_Action
{
	public function init()
	{

	}

	function clienteAction()
	{
		//select no banco na tabela albuns
		$cliente = new Application_Model_DbTable_Cliente();
		$this->view->cliente = $cliente->fetchAll();
	}

	function addclienteAction()
	{
		$form = new Application_Form_Cliente();
		$form->submit->setLabel('salvar');
		$this->view->form = $form;

		if ($this->getRequest()->isPost()) {

			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {

				$nomeCompleto = $form->getValue('NomeCompleto');
				$cpf = $form->getValue('Cpf');
				$rg = $form->getValue('Rg');

				$guardadata = explode('/', $form->getValue('DataNasc'));
				$data = $guardadata[2] . '-' . $guardadata[1] . '-' . $guardadata[0];

				$telefone = $form->getValue('Telefone');
				$celular = $form->getValue('Celular');
				$email = $form->getValue('Email');
				$rua = $form->getValue('Rua');
				$bairro = $form->getValue('Bairro');
				$numero = $form->getValue('Numero');
				$cep = $form->getValue('Cep');
				$cidade = $form->getValue('Cidade');
				$estado = $form->getValue('Estado');
				$pais = $form->getValue('Pais');

				$cliente = new Application_Model_DbTable_Cliente();
				$cliente->addCliente($nomeCompleto, $cpf, $rg,
				$data, $telefone, $celular, $email,
				$rua, $bairro, $numero, $cep,
				$cidade, $estado, $pais);

				$this->_helper->redirector('cliente');
			} else {
				$form->populate($formData);
			}
		}
	}

	function editclienteAction()
	{
		$form = new Application_Form_Cliente();
		$form->submit->setLabel('salvar');
		$this->view->form = $form;

		if ($this->getRequest()->isPost()) {

			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {

				$id = (int) $form->getValue('idCliente');
				$nomeCompleto = $form->getValue('NomeCompleto');
				$cpf = $form->getValue('Cpf');
				$rg = $form->getValue('Rg');
				$data = $form->getValue('DataNasc');
				$telefone = $form->getValue('Telefone');
				$celular = $form->getValue('Celular');
				$email = $form->getValue('Email');
				$rua = $form->getValue('Rua');
				$numero = $form->getValue('Numero');
				$bairro = $form->getValue('Bairro');
				$cep = $form->getValue('Cep');
				$cidade = $form->getValue('Cidade');
				$estado = $form->getValue('Estado');
				$pais = $form->getValue('Pais');

				$clientes = new Application_Model_DbTable_Cliente();
				$clientes->updateCliente($id, $nomeCompleto, $cpf, $rg,
				$data, $telefone, $celular, $email, $rua,
				$bairro, $numero, $cep, $cidade,
				$estado, $pais);
				$this->_helper->redirector('cliente');
			} else {
				$form->populate($formData);
			}
		} else {
			$id = $this->_getParam('idCliente', 0);
			if ($id > 0) {
				$cliente = new Application_Model_DbTable_Cliente();
				$form->populate($cliente->getCliente($id));
			}
		}
	}

	public function deleteclienteAction()
	{
		if ($this->getRequest()->isPost()) {
			$del = $this->getRequest()->getPost('del');

			$id = $this->getRequest()->getPost('idCliente');

			$vendaCliente = '';
			$venda = new Application_Model_DbTable_Venda();
			$verificandoCliente = $venda->verificaVenda($id);

			foreach ($verificandoCliente as $c) {
				$vendaCliente = $vendaCliente . $c->idVenda;
			}

			/* assina variavel para jogar na view */
			$this->view->vendaCliente = $vendaCliente;

			if ($del == 'Yes') {
				$id = $this->getRequest()->getPost('idCliente');
				$cliente = new Application_Model_DbTable_Cliente();
				$cliente->deleteCliente($id);
			}
			$this->_helper->redirector('cliente');
		} else {

			$id = $this->_getParam('idCliente', 0);

			$vendaCliente = '';
			$venda = new Application_Model_DbTable_Venda();
			$verificandoCliente = $venda->verificaVenda($id);

			foreach ($verificandoCliente as $c) {
				$vendaCliente = $vendaCliente . $c->idVenda;
			}

			/* assina variavel para jogar na view */
			$this->view->vendaCliente = $vendaCliente;

			$cliente = new Application_Model_DbTable_Cliente();
			$this->view->cliente = $cliente->getCliente($id);
		}
	}
}
