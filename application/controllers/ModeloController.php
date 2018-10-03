<?php

class ModeloController extends Zend_Controller_Action
{

	public function init()
	{

	}

	public function modeloAction()
	{
		$modelo = new Application_Model_DbTable_Modelo();
		$this->view->modelo = $modelo->fetchAll();
	}

	public function addmodeloAction()
	{
		//instancio a classe do formulario e jogo para a variavel
		$form = new Application_Form_Modelo();
		$form->submit->setLabel('salvar');
		$this->view->form = $form;
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$modelo = $form->getValue('Modelo');
				$marca = $form->getValue('Marca');
				echo $marca;
				$modelos = new Application_Model_DbTable_Modelo();
				$modelos->addModelo($modelo, $marca);
				$this->_helper->redirector('modelo');

			} else {
				$form->populate($formData);
			}
		}
	}

	public function editmodeloAction()
	{
		$form = new Application_Form_Modelo();
		$form->submit->setLabel('salvar');
		$this->view->form = $form;
		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$id = (int)$form->getValue('idModelo');
				$modelo = $form->getValue('Modelo');
				$marca = $form->getValue('Marca');

				$modelos = new Application_Model_DbTable_Modelo();
				$modelos->updateModelo($id, $modelo, $marca);
				$this->_helper->redirector('modelo');
			} else {
				$form->populate($formData);
			}
		} else {
			$id = $this->_getParam('idModelo', 0);
			if ($id > 0) {
				$modelo = new Application_Model_DbTable_Modelo();
				$form->populate($modelo->getModelo($id));
			}
		}
	}

	public function deletemodeloAction(){
		if ($this->getRequest()->isPost()) {
			$del = $this->getRequest()->getPost('del');

			$id = $this->getRequest()->getPost('idModelo');

			$modeloVeiculo = '';
			$Veiculo = new Application_Model_DbTable_Veiculo();
			$verificandoModelo = $Veiculo->verificaModelo($id);

			foreach ($verificandoModelo as $m){
				$modeloVeiculo = $modeloVeiculo . $m->idVeiculo;
			}

			/*assina variavel para jogar na view*/
			$this->view->modeloVeiculo = $modeloVeiculo;

			if ($del == 'Yes') {
				$id = $this->getRequest()->getPost('idModelo');
				$modelos = new Application_Model_DbTable_Modelo();
				$modelos->deleteModelo($id);
			}
			$this->_helper->redirector('modelo');
		} else {
			$id = $this->_getParam('idModelo', 0);

			$modeloVeiculo = '';
			$Veiculo = new Application_Model_DbTable_Veiculo();
		
			$verificandoModelo = $Veiculo->verificaModelo($id);
			foreach ($verificandoModelo as $m){
				$modeloVeiculo = $modeloVeiculo . $m->idVeiculo;
			}	

			/*assina variavel pra ser pega na view*/
			$this->view->modeloVeiculo = $modeloVeiculo;

			$modelos = new Application_Model_DbTable_Modelo();
			$this->view->modelo = $modelos->getModelo($id);

		}
	}
}


