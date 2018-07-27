<?php

class GastosveiculoController extends Zend_Controller_Action
{

	public function init(){

	}

	function gastosveiculoAction(){

		$gastosveiculo = new Application_Model_DbTable_Gastosveiculo();
		$this->view->gastosveiculo = $gastosveiculo->fetchAll();


	}

	//adiciona no album
	function addgastosveiculoAction(){

		$form = new Application_Form_Gastosveiculo();
		$form->submit->setLabel('salvar');
		$this->view->form = $form;

		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				
				$descricao = $form->getValue('Descricao');
				$totalgasto = $form->getValue('TotalGasto');
				$pago = $form->getValue('Pago');
				$veiculo_idVeiculo = $form->getValue('Veiculo');
				
				$guardaDataGasto = explode('/', $form->getValue('DataGasto'));
				$datagasto = $guardaDataGasto[2] . '-' . $guardaDataGasto[1] . '-' . $guardaDataGasto[0];
//				$datagasto = $form->getValue('DataGasto');
				
				$gastosveiculo = new Application_Model_DbTable_Gastosveiculo();
				$gastosveiculo->addGastosveiculo($descricao, $totalgasto, $pago, $veiculo_idVeiculo, $datagasto);

				$this->_helper->redirector('gastosveiculo');

			} else {
				$form->populate($formData);
			}
		}

	}

	function editgastosveiculoAction(){
		$form = new Application_Form_Gastosveiculo();
		$form->submit->setLabel('salvar');
		$this->view->form = $form;

		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {

				$id = (int)$form->getValue('idGastosveiculo');

				$descricao = $form->getValue('Descricao');
				$totalgasto = $form->getValue('TotalGasto');
				$pago = $form->getValue('Pago');
				$veiculo_idVeiculo = $form->getValue('Veiculo');
				$datagasto = $form->getValue('DataGasto');
				
				$gastosveiculo = new Application_Model_DbTable_Gastosveiculo();
				$gastosveiculo->updateGastosveiculo($id, $descricao, $totalgasto, $pago, $veiculo_idVeiculo, $datagasto);
				
				$this->_helper->redirector('gastosveiculo');
					
			} else {
				$form->populate($formData);
			}

		} else {
			$id = $this->_getParam('idGastosveiculo', 0);
			if ($id > 0) {
				$gastosveiculo = new Application_Model_DbTable_Gastosveiculo();
				$form->populate($gastosveiculo->getGastosveiculo($id));
			}
		}
	}

	public function deletegastosveiculoAction(){
		if ($this->getRequest()->isPost()) {
			$del = $this->getRequest()->getPost('del');
			if ($del == 'Yes') {
				$id = $this->getRequest()->getPost('idGastosveiculo');
				$gastosveiculo = new Application_Model_DbTable_Gastosveiculo();
				$gastosveiculo->deleteGastosveiculo($id);
			}
			$this->_helper->redirector('gastosveiculo');

		} else {
			$id = $this->_getParam('idGastosveiculo', 0);
			$gastosveiculo = new Application_Model_DbTable_Gastosveiculo();
			$this->view->gastosveiculo = $gastosveiculo->getGastosveiculo($id);
		}
	}






}








