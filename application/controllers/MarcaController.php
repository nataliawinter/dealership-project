<?php

class MarcaController extends Zend_Controller_Action
{

	public function init()
	{

	}

	public function marcaAction()
	{
		$marca = new Application_Model_DbTable_Marca();
		$this->view->marca = $marca->fetchAll();
	}

	public function addmarcaAction()
	{
		$form = new Application_Form_Marca();
		$form->submit->setLabel('salvar');
		$this->view->form = $form;

		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$marca = $form->getValue('Marca');

				$marcas = new Application_Model_DbTable_Marca();
				$marcas->addMarca($marca);
				$this->_helper->redirector('Marca');
			} else {
				$form->populate($formData);
			}
		}
	}

	function editmarcaAction()
	{
		$form = new Application_Form_Marca();
		$form->submit->setLabel('salvar');
		$this->view->form = $form;
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$id = (int)$form->getValue('idMarca');
				$marca = $form->getValue('Marca');
				$marcas = new Application_Model_DbTable_Marca();
				$marcas->updateMarca($id, $marca);
				$this->_helper->redirector('marca');
			} else {
				$form->populate($formData);
			}
		} else {
			$id = $this->_getParam('idMarca', 0);
			if ($id > 0) {
				$marca = new Application_Model_DbTable_Marca();
				$form->populate($marca->getMarca($id));
			}
		}
	}
	
	public function deletemarcaAction()
	{
		if ($this->getRequest()->isPost()) {
			$del = $this->getRequest()->getPost('del');

			$id = $this->getRequest()->getPost('idMarca');

			//VERICA SE A MARCA EXISTE NO MODELO. SE EXISTIR, NAO PODE SER EXCLUIDA
			$marcasModelo = '';
			$Marca = new Application_Model_DbTable_Modelo();
			$verificandoMarca = $Marca->verificaMarca($id);

			foreach ($verificandoMarca as $m){
				$marcasModelo = $marcasModelo . $m->idModelo;
			}

			/*assina variavel para jogar na view*/
			$this->view->marcasModelo = $marcasModelo;
			 
			if ($del == 'Yes') {

				$id = $this->getRequest()->getPost('idMarca');
				$marcas = new Application_Model_DbTable_Marca();
				$marcas->deletemarca($id);
			}
			$this->_helper->redirector('Marca');
		} else {
			$id = $this->_getParam('idMarca', 0);
			$marcasModelo = '';
			$Marca = new Application_Model_DbTable_Modelo();
			$verificandoMarca = $Marca->verificaMarca($id);
			foreach ($verificandoMarca as $m){
				$marcasModelo = $marcasModelo . $m->idModelo;
			}
			/*assina variavel para jogar na view*/
			$this->view->marcasModelo = $marcasModelo;
			
			$marcas = new Application_Model_DbTable_Marca();
			$this->view->marca = $marcas->getMarca($id);
		}
	}
}
