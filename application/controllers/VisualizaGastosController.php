<?php

class VisualizaGastosController extends Zend_Controller_Action
{
	public function init()
	{

	}

	function visualizagastosAction()
	{
		$gastosEmpresa = new Application_Model_DbTable_Gastosempresa();
		$this->view->totalGastosEmpresa = $gastosEmpresa->totalGastosEmpresa();
		
		$gastosVeiculo = new Application_Model_DbTable_Gastosveiculo();
		$this->view->totalGastosVeiculo = $gastosVeiculo->totalGastosVeiculo();
		
		$totalSalario = new Application_Model_DbTable_Empregado();
		$this->view->totalSalario = $totalSalario->totalSalario();
	}
}
