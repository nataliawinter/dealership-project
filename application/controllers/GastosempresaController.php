<?php

class GastosempresaController extends Zend_Controller_Action
{
	public function init()
	{

	}

	function gastosempresaAction()
	{
		$gastosempresa = new Application_Model_DbTable_Gastosempresa();
		$this->view->gastosempresa = $gastosempresa->fetchAll();
	}

	function addgastosempresaAction()
	{
		$form = new Application_Form_Gastosempresa();
		$form->submit->setLabel('salvar');
		$this->view->form = $form;

		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$detalhes = $form->getValue('Detalhes');
				$valor = $form->getValue('Valor');
				
				$guardaData = explode('/', $form->getValue('Data'));
				$data = $guardaData[2] . '-' . $guardaData[1] . '-' . $guardaData[0];
				
				$gastosempresa = new Application_Model_DbTable_Gastosempresa();
				$gastosempresa->addGastosempresa($detalhes, $valor, $data);

				$this->_helper->redirector('gastosempresa');

			} else {
				$form->populate($formData);
			}
		}
	}

	function editgastosempresaAction()
	{
		$form = new Application_Form_Gastosempresa();
		$form->submit->setLabel('salvar');
		$this->view->form = $form;

		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				
				$id = (int)$form->getValue('idGastosempresa');
				
				$detalhes = $form->getValue('Detalhes');
				$valor = $form->getValue('Valor');
				$data = $form->getValue('Data');

				$gastosempresa = new Application_Model_DbTable_Gastosempresa();
				$gastosempresa->updateGastosempresa($id, $detalhes, $valor, $data);
				$this->_helper->redirector('gastosempresa');
			} else {
				$form->populate($formData);
			}
		} else {
			$id = $this->_getParam('idGastosempresa', 0);
			if ($id > 0) {
				$gastosempresa = new Application_Model_DbTable_Gastosempresa();
				$form->populate($gastosempresa->getGastosempresa($id));
			}
		}
	}

	public function deletegastosempresaAction()
	{
		if ($this->getRequest()->isPost()) {
			$del = $this->getRequest()->getPost('del');
			if ($del == 'Yes') {
				$id = $this->getRequest()->getPost('idGastosempresa');
				$gastosempresa = new Application_Model_DbTable_Gastosempresa();
				$gastosempresa->deleteGastosempresa($id);
			}
			$this->_helper->redirector('gastosempresa');
		} else {
			$id = $this->_getParam('idGastosempresa', 0);
			$gastosempresa = new Application_Model_DbTable_Gastosempresa();
			$this->view->gastosempresa = $gastosempresa->getGastosempresa($id);
		}
	}
}
