<?php

class VeiculoController extends Zend_Controller_Action
{
	public function init()
	{

	}

	public function veiculoAction()
	{
		$veiculo = new Application_Model_DbTable_Veiculo();
		$this->view->veiculo = $veiculo->fetchAll();
	}

	public function addveicuAction()
	{
		$form = new Application_Form_Veiculo();
		$form->submit->setLabel('salvar');
		$this->view->form = $form;

		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$placa = $form->getValue('Placa');
				$cor = $form->getValue('Cor');
				$NroPortas = $form->getValue('NroPortas');
				$ItensOpcionais = $form->getValue('ItensOpcionais');
				$ValorPago = $form->getValue('ValorPago');
				$ValorVenda = $form->getValue('ValorVenda');
				$TotalGanho = $form->getValue('TotalGanho');
				$AnoModelo = $form->getValue('AnoModelo');
				$AnoFabricacao = $form->getValue('AnoFabricacao');
				$Combustivel = $form->getValue('Combustivel');
				$EstadoDeUso = $form->getValue('EstadoDeUso');
				$Status = $form->getValue('Status');
				$Modelo_idModelo = $form->getValue('Modelo');
				$Categoria_idCategoria = $form->getValue('Categoria');

				$veiculos = new Application_Model_DbTable_Veiculo();
				$veiculos->addVeiculo(
				$placa, $cor, $NroPortas, $ItensOpcionais, $ValorPago, $ValorVenda, $TotalGanho,
				$AnoModelo, $AnoFabricacao, $Combustivel, $EstadoDeUso, $Status, $Modelo_idModelo,
				$Categoria_idCategoria
				);
				$this->_helper->redirector('veiculo');
			} else {
				$form->populate($formData);
			}
		}
	}

	function editveiculoAction()
	{
		$form = new Application_Form_Veiculo();
		$form->submit->setLabel('salvar');
		$this->view->form = $form;

		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
	    	if ($form->isValid($formData)) {
				$id = (int) $form->getValue('idVeiculo');
				$placa = $form->getValue('Placa');
				$cor = $form->getValue('Cor');
				$NroPortas = $form->getValue('NroPortas');
				$ItensOpcionais = $form->getValue('ItensOpcionais');
				$ValorPago = $form->getValue('ValorPago');
				$ValorVenda = $form->getValue('ValorVenda');
				$TotalGanho = $form->getValue('TotalGanho');
				$AnoModelo = $form->getValue('AnoModelo');
				$AnoFabricacao = $form->getValue('AnoFabricacao');
				$Combustivel = $form->getValue('Combustivel');
				$EstadoDeUso = $form->getValue('EstadoDeUso');
				$Status = $form->getValue('Status');
				$Modelo_idModelo = $form->getValue('Modelo');
				$Categoria_idCategoria = $form->getValue('Categoria');

				$veiculos = new Application_Model_DbTable_Veiculo();
				$veiculos->updateVeiculo(
				$id, $placa, $cor, $NroPortas, $ItensOpcionais, $ValorPago, $ValorVenda,
				$TotalGanho, $AnoModelo, $AnoFabricacao, $Combustivel, $EstadoDeUso,
				$Status, $Modelo_idModelo, $Categoria_idCategoria
				);
				$this->_helper->redirector('veiculo');
			} else {				
				$form->populate($formData);
			}
		} else {
			$id = $this->_getParam('idVeiculo', 0);
			if ($id > 0) {
				$veiculos = new Application_Model_DbTable_Veiculo();
				$form->populate($veiculos->getVeiculo($id));
			}
		}
	}

	public function deleteveiculoAction()
	{
		if ($this->getRequest()->isPost()) {
			$del = $this->getRequest()->getPost('del');

			$id = $this->getRequest()->getPost('idVeiculo');

			//VERICA SE o veiculo existe em venda. 
			$vendasVeiculo = '';
			$venda = new Application_Model_DbTable_Venda();
			$verificandoVenda = $venda->verificaVeiculo($id);

			foreach ($verificandoVenda as $v){
				$vendasVeiculo = $vendasVeiculo . $v->idVenda;
			}

			/*assina variavel para jogar na view*/
			$this->view->vendasVeiculo = $vendasVeiculo;
			 
			if ($del == 'Yes') {

				$id = $this->getRequest()->getPost('idVeiculo');
				$veiculo = new Application_Model_DbTable_Veiculo();
				$veiculo->deleteveiculo($id);
			}
			$this->_helper->redirector('veiculo');
		} else {
			$id = $this->_getParam('idVeiculo', 0);
			//VERICA SE o veiculo existe em venda. 
			$vendasVeiculo = '';
			$venda = new Application_Model_DbTable_Venda();
			$verificandoVenda = $venda->verificaVeiculo($id);

			foreach ($verificandoVenda as $v){
				$vendasVeiculo = $vendasVeiculo . $v->idVenda;
			}

			/*assina variavel para jogar na view*/
			$this->view->vendasVeiculo = $vendasVeiculo;
			 			
			$veiculo = new Application_Model_DbTable_Veiculo();
			$this->view->veiculo = $veiculo->getVeiculo($id);
		}
	}
}
