<?php

class VendaController extends Zend_Controller_Action
{
	public function init()
	{

	}

	function vendaAction()
	{
		$venda = new Application_Model_DbTable_Venda();
		$this->view->venda = $venda->fetchAll();
	}

	function addvendaAction()
	{
		$form = new Application_Form_Venda();
		$form->submit->setLabel('Salvar');
		$this->view->form = $form;

		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {

				$formaPagamento = $form->getValue('FormaPagamento');
				$valorVenda = $form->getValue('ValorVenda');

				$guardadataVenda = explode('/', $form->getValue('DataVenda'));	
				$dataVenda = $guardadataVenda[2] . '-' . $guardadataVenda[1] . '-' . $guardadataVenda[0];

				$pago = $form->getValue('Pago');

				$guardadataPagto = explode('/', $form->getValue('DataPagto'));
				$dataPagto = $guardadataPagto[2] . '-' . $guardadataPagto[1] . '-' . $guardadataPagto[0];

				$veiculo_idVeiculo = $form->getValue('Veiculo');
				$cliente_idCliente = $form->getValue('Cliente');
				$empregado_idEmpregado = $form->getValue('Empregado');
				$banco = $form->getValue('Banco');

				/*descobre o valor da comissao*/
				$vendaComissao = new Application_Model_DbTable_Comissao();
				$comissaoDoVendedor = $vendaComissao->pegaValorComissao($valorVenda);
				/*apos descobrir quanto q sera a comissao, ele tira esse valor da venda total*/
				$valorVendaTotal = ($valorVenda - $comissaoDoVendedor);

				/*depois de ter descoberto o valor ele insere esse valor dentro da tabela empregado*/
				$empregadoComissao = new Application_Model_DbTable_Empregado();
				$comissaoEmpregado = $empregadoComissao->insereComissao($comissaoDoVendedor, $empregado_idEmpregado);

				$venda = new Application_Model_DbTable_Venda();
				$venda->addVenda($formaPagamento, $valorVendaTotal,
				$dataVenda, $pago, $dataPagto,
				$veiculo_idVeiculo, $cliente_idCliente,
				$empregado_idEmpregado, $banco);

				$this->_helper->redirector('venda');
			} else {
				$form->populate($formData);
			}
		}
	}

	function editvendaAction()
	{
		$form = new Application_Form_Venda();
		$form->submit->setLabel('Salvar');
		$this->view->form = $form;

		if ($this->getRequest()->isPost()) {
			$formData = $this->getRequest()->getPost();
			if ($form->isValid($formData)) {
				$id = (int) $form->getValue('idVenda');
				$formaPagamento = $form->getValue('FormaPagamento');
				$valorVenda = $form->getValue('ValorVenda');
				$dataVenda = $form->getValue('DataVenda');
				$pago = $form->getValue('Pago');
				$dataPagto = $form->getValue('DataPagto');
				$veiculo_idVeiculo = $form->getValue('Veiculo');
				$cliente_idCliente = $form->getValue('Cliente');
				$empregado_idEmpregado = $form->getValue('Empregado');
				$banco = $form->getValue('Banco');

				$venda = new Application_Model_DbTable_Venda();
				$venda->updateVenda($id, $formaPagamento, $valorVenda, $dataVenda, $pago, $dataPagto,
				$veiculo_idVeiculo, $cliente_idCliente,
				$empregado_idEmpregado, $banco);

				$this->_helper->redirector('venda');
			} else {
				$form->populate($formData);
			}
		} else {
			$id = $this->_getParam('idVenda', 0);
			if ($id > 0) {
				$venda = new Application_Model_DbTable_Venda();
				$form->populate($venda->getVenda($id));
			}
		}
	}

	public function deletevendaAction()
	{
		if ($this->getRequest()->isPost()) {
			$del = $this->getRequest()->getPost('del');
			if ($del == 'Yes') {
				$id = $this->getRequest()->getPost('idVenda');
				$venda = new Application_Model_DbTable_Venda();
				$venda->deleteVenda($id);
			}
			$this->_helper->redirector('venda');
		} else {
			$id = $this->_getParam('idVenda', 0);
			$venda = new Application_Model_DbTable_Venda();
			$this->view->venda = $venda->getVenda($id);
		}
	}
}
