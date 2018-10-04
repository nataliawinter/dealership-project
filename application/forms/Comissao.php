<?php

class Application_Form_Comissao extends Zend_Form
{
	public function init()
	{
		$this->setName('addComissao');

		$id = new Zend_Form_Element_Hidden('idComissao');
		$id->addFilter('Int');

		$de = new Zend_Form_Element_Text('De');
		$de->setLabel('De :')
		   ->setRequired(true)
		   ->addFilter('StripTags')
		   ->addFilter('StringTrim')
		   ->addValidator('NotEmpty');

		$ate = new Zend_Form_Element_Text('Ate');
		$ate->setLabel('Até: ')
		    ->setRequired(true)
	     	->addFilter('StripTags')
		    ->addFilter('StringTrim')
		    ->addValidator('NotEmpty');

		$valor = new Zend_Form_Element_Text('Valor');
		$valor->setLabel('Valor: ')
		      ->setRequired(true)
		      ->addFilter('StripTags')
		      ->addFilter('StringTrim')
		      ->addValidator('NotEmpty');

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('idComissao', 'submitbutton');
		$this->addElements([$id, $de, $ate, $valor, $submit]);
	}
}