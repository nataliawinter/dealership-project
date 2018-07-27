<?php
class Application_Form_Album extends Zend_Form
{
	public function init()
	{
		$this->setName('album');
		$id = new Zend_Form_Element_Hidden('id');
		$id->addFilter('Int');
		$artist = new Zend_Form_Element_Text('artist');

		$artist->setLabel('Placa')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');


		$title = new Zend_Form_Element_Text('title');
		$title->setLabel('Valor Entrada')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$title1 = new Zend_Form_Element_Text('title1');
		$title1->setLabel('Valor Venda')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$title2 = new Zend_Form_Element_Text('title2');
		$title2->setLabel('Valor Ganho')
		->setRequired(true)
		->addFilter('StripTags')
		->addFilter('StringTrim')
		->addValidator('NotEmpty');

		$submit = new Zend_Form_Element_Submit('submit');
		$submit->setAttrib('id', 'submitbutton');
		$this->addElements(array($id, $artist, $title, $title1, $title2, $submit));
	}
}