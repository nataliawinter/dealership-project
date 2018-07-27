<?php
class Application_Form_Modelo extends Zend_Form
{
	public function init()
	{
		$this->setName('addmodelo');
		$id = new Zend_Form_Element_Hidden('idModelo');
		$id->addFilter('Int');

		$modelo = new Zend_Form_Element_Text("Modelo");
		$modelo->setLabel('Modelo: ')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$tabelaMarca = new Zend_Form_Element_Select("Marca");
		$tabelaMarca->setLabel('Marca:')
		->setRequired('true');

		$Marca = new Application_Model_DbTable_Marca();

		foreach($Marca->pegaMarca() as $m){
			$tabelaMarca->addMultiOption($m->idMarca, $m->Marca);
		}

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('idModelo', 'submitbutton');
		$this->addElements(array($id, $modelo, $tabelaMarca, $submit));
	}
}