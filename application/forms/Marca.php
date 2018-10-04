<?php

class Application_Form_Marca extends Zend_Form
{
    public function init()
    {
        $this->setName('addmarca');
        
        $id = new Zend_Form_Element_Hidden('idMarca');
        $id->addFilter('Int');

        $marca = new Zend_Form_Element_Text('Marca');
        $marca->setLabel('Marca: ')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('idMarca', 'submitbutton');
        $this->addElements(array($id, $marca, $submit));
    }

}