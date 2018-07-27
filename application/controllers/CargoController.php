<?php

class CargoController extends Zend_Controller_Action {

	public function init() {

	}

	function cargoAction() {
		//select no banco da tabela cargo
		$cargo = new Application_Model_DbTable_Cargo();
		$this->view->cargo = $cargo->fetchAll();
	}

	///adiciona ve�culo
	public function addcargoAction() {
		$form = new Application_Form_Cargo();

		$form->submit->setLabel('salvar');
		$this->view->form = $form;

		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {

				$cargo = $form->getValue('Cargo');

				$cargos = new Application_Model_DbTable_Cargo();
				$cargos->addcargo($cargo);

				$this->_helper->redirector('Cargo');
			} else {

				$form->populate($formData);
			}
		}
	}

	//edita no banco tabela cargo
	function editcargoAction() {
		$form = new Application_Form_Cargo();
		$form->submit->setLabel('salvar');
		$this->view->form = $form;

		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {

				$id = (int) $form->getValue('idCargo');
				$cargo = $form->getValue('Cargo');

				$cargos = new Application_Model_DbTable_Cargo();
				$cargos->updatecargo($id, $cargo);
				$this->_helper->redirector('cargo');
			} else {
				$form->populate($formData);
			}
		} else {
			$id = $this->_getParam('idCargo', 0);
			if ($id > 0) {
				$cargo = new Application_Model_DbTable_Cargo();
				$form->populate($cargo->getCargo($id));
			}
		}
	}

	//    public function deletecargoAction() {
	//        if ($this->getRequest()->isPost()) {
	//            $del = $this->getRequest()->getPost('del');
	//            if ($del == 'Yes') {
	//                $id = $this->getRequest()->getPost('idCargo');
	//                $Cargos = new Application_Model_DbTable_Cargo();
	//                $Cargos->deletecargo($id);
	//            }
	//            $this->_helper->redirector('cargo');
	//        } else {
	//            $id = $this->_getParam('idCargo', 0);
	//            $Cargos = new Application_Model_DbTable_Cargo();
	//            $this->view->cargo = $Cargos->getCargo($id);
	//        }
	//    }

	public function deletecargoAction() {
		if ($this->getRequest()->isPost()) {
			$del = $this->getRequest()->getPost('del');

			$id = $this->getRequest()->getPost('idCargo');

			$cargos = '';
			$empregado = new Application_Model_DbTable_Empregado();
			$verificandoCargo = $empregado->verificaCargo($id);

			foreach ($verificandoCargo as $c){
				$cargos = $cargos . $c->idEmpregado;
			}

			/*assina variavel para jogar na view*/
			$this->view->cargos = $cargos;

			if ($del == 'Yes') {
				$id = $this->getRequest()->getPost('idCargo');
				$Cargos = new Application_Model_DbTable_Cargo();
				$Cargos->deletecargo($id);
			}
			$this->_helper->redirector('cargo');
		} else {
			$id = $this->_getParam('idCargo', 0);

						$cargos = '';
			$empregado = new Application_Model_DbTable_Empregado();
			$verificandoCargo = $empregado->verificaCargo($id);

			foreach ($verificandoCargo as $c){
				$cargos = $cargos . $c->idEmpregado;
			}
			/*assina variavel para jogar na view*/
			$this->view->cargos = $cargos;
			
			$Cargos = new Application_Model_DbTable_Cargo();
			$this->view->cargo = $Cargos->getCargo($id);
		}
	}

}

