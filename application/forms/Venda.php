<?php

class Application_Form_Venda extends Zend_Form {

	public function init() {

		$form = new Zend_Form();
				
		$this->setName('venda');

		$id = new Zend_Form_Element_Hidden('idVenda');
		$id->addFilter('Int');

		$formaPagamento = new Zend_Form_Element_Select("FormaPagamento");
		$formaPagamento->setLabel("Forma de Pagamento: ")
		->setRequired(true)
		->addValidator('NotEmpty');

		$formaPagamento->addMultiOptions(array(
		' ' => 'Selecione', 
		'Vista' => 'Vista', 
		'Prazo' => 'Prazo', 
		'Cartao' => 'Cartao', 
		'Cheque' => 'Cheque', 
		'Deposito' => 'Deposito')
		);

		$banco = new Zend_Form_Element_Select("Banco");
		$banco->setLabel("Banco: ")
		->setRequired(true)
		->addValidator('NotEmpty');

		$banco->addMultiOptions(array(
		' ' => 'Selecione', 
		'Bradesco' => 'Bradesco', 
		'Itau' => 'Itau', 
		'Brasil' => 'Brasil', 
		'Santander' => 'Santander', 
		'Caixa' => 'Caixa')
		);
		 
		$valorVenda = new Zend_Form_Element_Text('ValorVenda');
		$valorVenda->setLabel('Valor Venda')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$dataVenda = new Zend_Form_Element_Text('DataVenda');
		$dataVenda->setLabel('Data Venda')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$selectPago = new Zend_Form_Element_Select("Pago");
		$selectPago->setLabel("Pago: ");
		$selectPago->addMultiOptions(array('1' => 'Sim', '0' => 'Nao'));


		$dataPagto = new Zend_Form_Element_Text('DataPagto');
		$dataPagto->setLabel('Data Pagamento: ')
		->addFilter('StripTags')
		->addFilter('StringTrim');

		$veiculo_idVeiculo = new Zend_Form_Element_Select("Veiculo");
		$veiculo_idVeiculo->setLabel('Veiculo:')
		->setRequired('true');

		$veiculo = new Application_Model_DbTable_Veiculo();
		foreach ($veiculo->pegaVeiculo() as $v) {
			$veiculo_idVeiculo->addMultiOption($v->idVeiculo, $v->Placa);
		}

		$cliente_idCliente = new Zend_Form_Element_Select("Cliente");
		$cliente_idCliente->setLabel('Cliente:')
		->setRequired('true');

		$cliente = new Application_Model_DbTable_Cliente();
		foreach ($cliente->pegaCliente() as $c) {
			$cliente_idCliente->addMultiOption($c->idCliente, $c->NomeCompleto);
		}

		$empregado_idEmpregado = new Zend_Form_Element_Select("Empregado");
		$empregado_idEmpregado->setLabel('Empregado: ')
		->setRequired('true');

		$empregado = new Application_Model_DbTable_Empregado();
		foreach ($empregado->pegaEmpregado() as $e) {
			$empregado_idEmpregado->addMultiOption($e->idEmpregado, $e->NomeCompleto);
		}

	
		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('idVenda', 'submitbutton');
		$this->addElements(
		array(
		$id, $formaPagamento, $banco, $valorVenda, $dataVenda,
		$selectPago, $dataPagto,
		$veiculo_idVeiculo, $cliente_idCliente,
		$empregado_idEmpregado, $submit
		)
		);
	}

}