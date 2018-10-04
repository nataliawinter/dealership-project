<?php

class Application_Form_Cargo extends Zend_Form
{
    public function init()
    {
        $this->setName('addcargo');
        
        $id = new Zend_Form_Element_Hidden('idCargo');
        $id->addFilter('Int');

        $cargo = new Zend_Form_Element_Text('Cargo');
        $cargo->setLabel('Cargo: ')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('idCargo', 'submitbutton');
        $this->addElements([$id, $cargo, $submit]);
    }

}