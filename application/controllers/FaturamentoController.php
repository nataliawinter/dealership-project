<?php

class FaturamentoController extends Zend_Controller_Action
{

	public function init(){

	}

	function faturamentoAction(){

		$Veiculo = new Application_Model_DbTable_Veiculo();
		$this->view->totalVeiculo = $Veiculo->totalVeiculosGanho();
		
		$totalVendas = new Application_Model_DbTable_Venda();
		$this->view->totalVendasFeitas = $totalVendas->totalVenda();

	}


}








