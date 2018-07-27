<?php

class Application_Form_Cliente extends Zend_Form {

	public function init() {

		$this->setName('cliente');

		$id = new Zend_Form_Element_Hidden('idCliente');
		$id->addFilter('Int');

		$nomeCompleto = new Zend_Form_Element_Text('NomeCompleto');
		$nomeCompleto->setLabel('Nome Completo: ')
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

		$data = new Zend_Form_Element_Text('DataNasc');
		$data->setLabel('Data Nascimento: ')
		->addFilter('StripTags')
		->addFilter('StringTrim');

		$telefone = new Zend_Form_Element_Text('Telefone');
		$telefone->setLabel('Telefone: ')
		->addFilter('StripTags')
		->addFilter('StringTrim');


		$celular = new Zend_Form_Element_Text('Celular');
		$celular->setLabel('Celular: ')
		->addFilter('StripTags')
		->addFilter('StringTrim');

		$email = new Zend_Form_Element_Text('Email');
		$email->setLabel('Email: ')
		->addFilter('StripTags')
		->addFilter('StringTrim');

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
		$submit->setAttrib('idCliente', 'submitbutton');
		$this->addElements(array($id, $nomeCompleto, $cpf, $rg, $data, $telefone, $celular, $email, $rua, $bairro, $numero, $cep, $cidade, $estado, $pais, $submit));
	}

}