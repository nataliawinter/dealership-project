<?php

class Application_Form_Categoria extends Zend_Form {

    public function init() {

        $this->setName('addcategoria');
        
        $id = new Zend_Form_Element_Hidden('idCategoria');
        $id->addFilter('Int');
        
        $categoria = new Zend_Form_Element_Text('Categoria');
        $categoria->setLabel('Categoria: ')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('idCategoria', 'submitbutton');
        $this->addElements(array($id, $categoria, $submit));
    }

}