<?php

class ComissaoController extends Zend_Controller_Action
{

	public function init()
	{

	}

	function comissaoAction()
	{
		//select no banco na tabela albuns
		$comissao = new Application_Model_DbTable_Comissao();
		$this->view->comissao = $comissao->fetchAll();
	}

	function addcomissaoAction()
	{
		//instancio a classe do formulario e jogo para a variavel $form
		$form = new Application_Form_Comissao();
		$form->submit->setLabel('salvar');

		$this->view->form = $form;
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$de = $form->getValue('De');
				$ate = $form->getValue('Ate');
				$valor = $form->getValue('Valor');

				$comissao = new Application_Model_DbTable_Comissao();
				$comissao->addComissao($de, $ate, $valor);

				$this->_helper->redirector('comissao');

			} else {
				$form->populate($formData);
			}
		}
	}

	function editcomissaoAction()
	{
		$form = new Application_Form_Comissao();
		$form->submit->setLabel('salvar');
		$this->view->form = $form;
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();

			if ($form->isValid($formData)) {
				$id = (int) $form->getValue('idComissao');
				$de = $form->getValue('De');
				$ate = $form->getValue('Ate');
				$valor = $form->getValue('Valor');
				
				$comissao = new Application_Model_DbTable_Comissao();
				$comissao->updateComissao($id, $de, $ate, $valor);
				$this->_helper->redirector('comissao');
			} else {
				$form->populate($formData);
			}
		} else {
			$id = $this->_getParam('idComissao', 0);
			if ($id > 0) {
				$comissao = new Application_Model_DbTable_Comissao();
				$form->populate($comissao->getComissao($id));
			}
		}
	}

	public function deletecomissaoAction()
	{
		if ($this->getRequest()->isPost()) {
			$del = $this->getRequest()->getPost('del');
			if ($del == 'Yes') {
				$id = $this->getRequest()->getPost('idComissao');
				$comissao = new Application_Model_DbTable_Comissao();
				$comissao->deleteComissao($id);
			}
			$this->_helper->redirector('comissao');
		} else {
			$id = $this->_getParam('idComissao', 0);
			$comissao = new Application_Model_DbTable_Comissao();
			$this->view->comissao = $comissao->getComissao($id);
		}
	}
}
