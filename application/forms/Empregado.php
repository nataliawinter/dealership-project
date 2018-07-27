<?php

class Application_Form_Empregado extends Zend_Form {

	public function init() {

		$this->setName('addEmpregado');

		$id = new Zend_Form_Element_Hidden('idEmpregado');
		$id->addFilter('Int');

		$nomeCompleto = new Zend_Form_Element_Text('NomeCompleto');
		$nomeCompleto->setLabel('Nome Completo: ')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$email = new Zend_Form_Element_Text('Email');
		$email->setLabel('Email: ')
		->addFilter('StripTags')
		->addFilter('StringTrim');

		$dataNasc = new Zend_Form_Element_Text('DataNasc');
		$dataNasc->setLabel('Data de Nascimento: ')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$cpf = new Zend_Form_Element_Text('Cpf');
		$cpf->setLabel('Cpf: ')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$rg = new Zend_Form_Element_Text('Rg');
		$rg->setLabel('Rg: ')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$nroCarteiraTrab = new Zend_Form_Element_Text('NroCarteiraTrab');
		$nroCarteiraTrab->setLabel('Nro Carteira de Trab: ')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$telefone = new Zend_Form_Element_Text('Telefone');
		$telefone->setLabel('Telefone: ')
		->addFilter('StripTags')
		->addFilter('StringTrim');

		$celular = new Zend_Form_Element_Text('Celular');
		$celular->setLabel('Celular: ')
		->addFilter('StripTags')
		->addFilter('StringTrim');

		$salario = new Zend_Form_Element_Text('Salario');
		$salario->setLabel('Salario: ')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$rua = new Zend_Form_Element_Text('Rua');
		$rua->setLabel('Rua: ')
		->addFilter('StripTags')
		->addFilter('StringTrim');

		$bairro = new Zend_Form_Element_Text('Bairro');
		$bairro->setLabel('Bairro: ')
		->addFilter('StripTags')
		->addFilter('StringTrim');

		$numero = new Zend_Form_Element_Text('Numero');
		$numero->setLabel('Numero: ')
		->addFilter('StripTags')
		->addFilter('StringTrim');

		$cep = new Zend_Form_Element_Text('Cep');
		$cep->setLabel('Cep: ')
		->addFilter('StripTags')
		->addFilter('StringTrim');

		$cargo_idCargo = new Zend_Form_Element_Select("Cargo");
		$cargo_idCargo->setLabel('Cargo:')
		->setRequired('true');

		$cargo = new Application_Model_DbTable_Cargo();
		foreach ($cargo->pegaCargo() as $c) {
			$cargo_idCargo->addMultiOption($c->idCargo, $c->Cargo);
		}

		$tipoContrato = new Zend_Form_Element_Select("TipoContrato");
		$tipoContrato->setLabel('Tipo do contrato: ');
		$tipoContrato->addMultiOptions(array(' ' => 'Selecione', '1' => 'Estagio', '2' => 'Contratado'));
		
		$dataInicio = new Zend_Form_Element_Text('DataInicio');
		$dataInicio->setLabel('Data de Inicio: ')
		->addFilter('StripTags')
		->addFilter('StringTrim');

		$cidade = new Zend_Form_Element_Text('Cidade');
		$cidade->setLabel('Cidade: ')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$estado = new Zend_Form_Element_Select('Estado');
		$estado->setLabel('Estado: ');
		$estado->addMultiOptions(
		array(
                    ' ' => 'UF',
                    'AC' => 'AC',
                    'AL' => 'AL',
                    'AP' => 'AP',
                    'AM' => 'AM',
                    'BA' => 'BA',
                    'CE' => 'CE',
                    'DF' => 'DF',
                    'ES' => 'ES',
                    'GO' => 'GO',
                    'MA' => 'MA',
                    'MT' => 'MT',
                    'MS' => 'MS',
                    'MG' => 'MG',
                    'PA' => 'PA',
                    'PB' => 'PB',
                    'PR' => 'PR',
                    'PE' => 'PE',
                    'PI' => 'PI',
                    'RJ' => 'RJ',
                    'RN' => 'RN',
                    'RS' => 'RS',
                    'RO' => 'RO',
                    'RR' => 'RR',
                    'SC' => 'SC',
                    'SP' => 'SP',
                    'SE' => 'SE',
                    'TO' => 'TO',
		)
		);


		$pais = new Zend_Form_Element_Text('Pais');
		$pais->setLabel('Pais: ')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('idEmpregado', 'submitbutton');
		$this->addElements(
		array(
		$nomeCompleto, $email, $dataNasc, $cpf, $rg,
		$nroCarteiraTrab, $telefone, $celular, $salario, $rua, $bairro, $numero, $cep,
		$cargo_idCargo, $tipoContrato, $dataInicio, $cidade, $estado, $pais, $submit)
		);
	}

}