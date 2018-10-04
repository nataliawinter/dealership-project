<?php

class Application_Form_Gastosempresa extends Zend_Form
{
	public function init()
	{
		$this->setName('Gastosempresa');

		$id = new Zend_Form_Element_Hidden('idGastosempresa');
		$id->addFilter('Int');

		$detalhes = new Zend_Form_Element_Textarea('Detalhes');
		$detalhes->setLabel('Detalhes: ')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty')
		->SetAttrib('cols', '16')
		->SetAttrib('rows', '4');

		$valor = new Zend_Form_Element_Text('Valor');
		$valor->setLabel('Valor: ')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$data = new Zend_Form_Element_Text('Data');
		$data->setLabel('Data: ')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('idGastosempresa', 'submitbutton');
		$this->addElements(array($id, $detalhes, $valor, $data, $submit));
	}

}