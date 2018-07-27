<?php

class Application_Form_Gastosveiculo extends Zend_Form {

	public function init() {

		$this->setName('Gastosveiculo');

		$id = new Zend_Form_Element_Hidden('idGastosveiculo');
		$id->addFilter('Int');

		$descricao = new Zend_Form_Element_Textarea('Descricao');
		$descricao->setLabel('Descricao: ')
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->SetAttrib('cols', '16')
		->SetAttrib('rows', '4');
		
		$totalgasto = new Zend_Form_Element_Text('TotalGasto');
		$totalgasto->setLabel('Total gasto no veiculo: ')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');
   
		$pago = new Zend_Form_Element_Select('Pago');
        $pago->setLabel("Pago: ");
        $pago->addMultiOptions(array(' ' => 'Selecione', '1' => 'Sim', '0' => 'Nao'));

		$veiculo_idVeiculo = new Zend_Form_Element_Select('Veiculo');
		$veiculo_idVeiculo->setLabel('Veiculo: ')
		->setRequired('true');

		$veiculo = new Application_Model_DbTable_Veiculo();
		foreach ($veiculo->pegaVeiculo() as $v) {
			$veiculo_idVeiculo->addMultiOption($v->idVeiculo, $v->Placa);
		}

		$datagasto = new Zend_Form_Element_Text('DataGasto');
		$datagasto->setLabel('Data do Gasto: ')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');


		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('idGastosveiculo', 'submitbutton');
		$this->addElements(array($id, $descricao, $totalgasto, $pago, $veiculo_idVeiculo, $datagasto, $submit));
	}

}